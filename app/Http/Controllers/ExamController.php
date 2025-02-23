<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $query = Exam::query();
        // Search, filter, and sort
        if ($request->has('search')) {
            $query->join('classes', 'classes.id', '=', 'exams.class_id')
            ->where('classes.name', 'like', '%' . $request->input('search') . '%');
        }

        // Allowed sorting columns
        $allowedColumns = ['class_id', 'subject','exam_date'];
        $sortBy = $request->input('sort_by');

        if (in_array($sortBy, $allowedColumns)) {
            $sortOrder = $request->input('sort_order', 'asc'); // Default to ascending
            $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc'; // Ensure valid order

            $query->orderBy($sortBy, $sortOrder);
        }

        $exams = $query->paginate(10);
        $noResults = $exams->isEmpty();
        return view('exams.index', compact('exams', 'noResults'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        return view('exams.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required',
            'subject' => 'required',
            'exam_date' => 'required|date',
        ]);

        $isExist = Exam::where('subject', $validated['subject'])->first();
        // dd($isTeacher->id);
        if ($isExist) {
            return redirect()->back()->with('error', 'Subject already exists in the list.');
        }

        $data = Exam::create([
            'class_id' => $validated['class_id'],
            'subject' => $validated['subject'],
            'exam_date' => $validated['exam_date'],    // Example static value; replace it with dynamic input if necessary
        ]);
        // Check if both user and class exist
        if ($data) {
            // Set success message
            return redirect()->route('exams.index')->with('success', 'Congrat!You have create done.');
        } else {
            // Redirect back to the students index page
            return redirect()->route('exams.create')->with('error', 'Sorry?You have created failed.');
        }
    }

    public function edit(Exam $exam)
    {
        $classes = SchoolClass::all();
        return view('exams.edit', compact('exam', 'classes'));
    }

    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'class_id' => 'required',
            'subject' => 'required',
            'exam_date' => 'required|date',
        ]);

        $data = $exam->update($validated);

        if ($data) {
            // Set success message
            return redirect()->route('exams.index')->with('success', 'Congrat!You have edited done.');
        } else {
            // Redirect back to the students index page
            return redirect()->route('exams.edit')->with('error', 'Sorry?You have edited failed.');
        }
    }

    public function destroy(Exam $exam)
    {
        $data = $exam->results()->delete();
        $data = $exam->delete();
        if ($data) {
            // Set success message
            return redirect()->route('exams.index')->with('success', 'Congrat!You have deleted done.');
        } else {
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry?You have deleted failed.');
        }
    }
}
