<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index(Request $request)
    {
        $query = SchoolClass::query();
        // Search, filter, and sort
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        // Allowed sorting columns
        $allowedColumns = ['name', 'teacher_id'];
        $sortBy = $request->input('sort_by');

        if (in_array($sortBy, $allowedColumns)) {
            $sortOrder = $request->input('sort_order', 'asc'); // Default to ascending
            $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc'; // Ensure valid order

            $query->orderBy($sortBy, $sortOrder);
        }

        $schoolClasses = $query->paginate(10);
        $noResults = $schoolClasses->isEmpty();
        return view('schoolclasses.index', compact('schoolClasses','noResults'));
    }

    public function create()
    {
        $teacher = Teacher::all();
        return view('schoolclasses.create',compact('teacher'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required',
            'name' => 'required'
        ]);


        $data = SchoolClass::create([
            'teacher_id' => $validated['teacher_id'],
            'name' => $validated['name'],
        ]);
        // Check if both user and class exist
        if ($data) {
            // Set success message
            return redirect()->route('schoolClass.index')->with('success', 'Congrat!You have create done.');
        }else{
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry!You have created failed.');
        }
    }

    public function edit(SchoolClass $schoolClass)
    {
        $teacher = Teacher::all();
        return view('schoolclasses.edit', compact('schoolClass','teacher'));
    }

    public function update(Request $request, SchoolClass $schoolClass)
    {
        $validated = $request->validate([
            'teacher_id' => 'required',
            'name' => 'required'
        ]);

        $data = $schoolClass->update($validated);
        // Check if both user and class exist
        if ($data) {
            // Set success message
            return redirect()->route('schoolClass.index')->with('success', 'Congrat!You have edited done.');
        }else{
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry!You have edited failed.');
        }
    }

    public function destroy(SchoolClass $schoolClass)
    {
        $data = $schoolClass->students()->delete();
        $data = $schoolClass->exams()->delete();
        $data = $schoolClass->delete();

        if ($data) {
            // Set success message
            return redirect()->route('schoolClass.index')->with('success', 'Congrat!You have deleted done.');
        }else{
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry!You have deleted failed.');
        }
    }
}
