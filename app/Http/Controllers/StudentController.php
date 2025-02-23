<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();
        // Search, filter, and sort
        if ($request->has('search')) {
            $query->join('users', 'users.id', '=', 'students.user_id')
                ->where('users.name', 'like', '%' . $request->input('search') . '%');
        }

        // Allowed sorting columns
        $allowedColumns = ['user_id', 'class_id','parent_name'];
        $sortBy = $request->input('sort_by');

        if (in_array($sortBy, $allowedColumns)) {
            $sortOrder = $request->input('sort_order', 'asc'); // Default to ascending
            $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc'; // Ensure valid order

            $query->orderBy($sortBy, $sortOrder);
        }

        $students = $query->paginate(10);
        $noResults = $students->isEmpty();
        return view('students.index', compact('students','noResults'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        $user = User::all();
        return view('students.create',compact('classes','user'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'user_id' => 'required',
            'parent_name' => 'required',
            'parent_contact' => 'required',
            'class_id' => 'required',
            'date_of_birth' => 'required',
        ]);

        $isExist = Student::where('user_id', $validated['user_id'])->first();
        // dd($isTeacher->id);
        if ($isExist) {
            return redirect()->back()->with('error', 'Student already exists in the list.');
        }

        $data = Student::create([
            'user_id' => $validated['user_id'],
            'class_id' => $validated['class_id'],
            'parent_name' => $validated['parent_name'],  // Example static value; replace it with dynamic input if necessary
            'parent_contact' => $validated['parent_contact'],  // Example static value; replace it with dynamic input if necessary
            'date_of_birth' => $validated['date_of_birth'],  // Example static value; replace it with dynamic input if necessary
        ]);
        // Check if both user and class exist
        if ($data) {
            // Set success message
            return redirect()->route('students.index')->with('success', 'Congrat!You have create done.');
        }else{
            // Redirect back to the students index page
            return redirect()->route('students.create')->with('error', 'Student created failed.');
        }
    }

    public function edit(Student $student)
    {
        $classes = SchoolClass::all();
        $user = User::all();
        return view('students.edit', compact('student','classes','user'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'parent_name' => 'required',
            'parent_contact' => 'required',
            'class_id' => 'required',
            'date_of_birth' => 'required',
        ]);

        $data = $student->update($validated);

        if ($data) {
            // Set success message
            return redirect()->route('students.index')->with('success', 'Congrat!You have edited done.');
        }else{
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Student edited failed.');
        }
    }

    public function destroy(Student $student)
    {
        $data = $student->examResults()->delete();  // Delete related results before deleting the student
        $data = $student->attendance()->delete();  // Delete related results before deleting the student
        $data = $student->fees()->delete();  // Delete related results before deleting the student
        $data = $student->delete();

        if ($data) {
            // Set success message
            return redirect()->route('students.index')->with('success', 'Congrat!You have edited done.');
        } else {
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Student edited failed.');
        }
    }
}

