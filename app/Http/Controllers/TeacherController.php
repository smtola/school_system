<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::query();

        // Search, filter, and sort
        if ($request->has('search')) {
            $query->join('users', 'users.id', '=', 'teachers.user_id')
                ->where('users.name', 'like', '%' . $request->input('search') . '%');
        }

        // Allowed sorting columns
        $allowedColumns = ['user_id', 'subject'];
        $sortBy = $request->input('sort_by');

        if (in_array($sortBy, $allowedColumns)) {
            $sortOrder = $request->input('sort_order', 'asc'); // Default to ascending
            $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc'; // Ensure valid order

            $query->orderBy($sortBy, $sortOrder);
        }

        $teachers = $query->paginate(10);
        $noResults = $teachers->isEmpty();
        return view('teachers.index', compact('teachers','noResults'));
    }

    public function create()
    {
        $user = User::all();
        return view('teachers.create',compact('user'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'user_id' => 'required',
            'subject' => 'required',
            'contact' => 'required'
        ]);

        $isExist = Teacher::where('user_id', $validated['user_id'])->first();
        // dd($isTeacher->id);
        if($isExist){
            return redirect()->back()->with('error', 'Teacher already exists in the list.');
        }

        $data = Teacher::create([
            'user_id' => $validated['user_id'],
            'subject' => $validated['subject'],
            'contact' => $validated['contact']
        ]);
        // Check if both user and class exist
        if ($data) {
            // Set success message
            return redirect()->route('teachers.index')->with('success', 'Congrat!You have create done.');
        }else{
            // Redirect back to the students index page
            return redirect()->redirect()->back()->with('error', 'Student created failed.');
        }
    }

    public function edit(Teacher $teacher)
    {
        $user = User::all();
        return view('teachers.edit', compact('teacher','user'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'subject' => 'required',
            'contact' => 'required'
        ]);

        $data = $teacher->update($validated);
        if ($data) {
            // Set success message
            return redirect()->route('teachers.index')->with('success', 'Congrat!You have edited done.');
        }else{
            // Redirect back to the students index page
            return redirect()->redirect()->back()->with('error', 'Student edited failed.');
        }
    }

    public function destroy(Teacher $teacher)
    {
        $data = $teacher->classes()->delete();
        $data = $teacher->delete();
        if ($data) {
            // Set success message
            return redirect()->route('teachers.index')->with('success', 'Congrat!You have deleted done.');
        }else{
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry!You have deleted failed.');
        }
    }
}

