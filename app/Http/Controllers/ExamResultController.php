<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Student;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    public function index(Request $request)
    {
        $query = ExamResult::query();
        // Search, filter, and sort
        if ($request->has('search')) {
            $query->join('exams', 'exams.id', '=', 'exam_results.exam_id')
            ->where('exams.subject', 'like', '%' . $request->input('search') . '%');
        }

        // Allowed sorting columns
        $allowedColumns = ['student_id', 'exam_id', 'grade'];
        $sortBy = $request->input('sort_by');

        if (in_array($sortBy, $allowedColumns)) {
            $sortOrder = $request->input('sort_order', 'asc'); // Default to ascending
            $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc'; // Ensure valid order

            $query->orderBy($sortBy, $sortOrder);
        }

        $exams = $query->paginate(10);
        $noResults = $exams->isEmpty();
        return view('exam_results.index', compact('exams', 'noResults'));
    }
    public function create()
    {
        $students = Student::all();
        $exams = Exam::all();
        return view('exam_results.create', compact('students', 'exams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required',
            'exam_id' => 'required',
            'score' => 'required',
        ]);

        $avgGrade = $validated['score'];
        $grade = '';
        if ($avgGrade >= 100) {
            return redirect()->route('exams.create')->with('error', 'Sorry? Score must be less than 100%.');
        }else if ($avgGrade >= 90) {
            $grade = 'A';
        } elseif ($avgGrade >= 80) {
            $grade = 'B';
        } elseif ($avgGrade >= 70) {
            $grade = 'C';
        } elseif ($avgGrade >= 60) {
            $grade = 'D';
        } elseif ($avgGrade >= 50) {
            $grade = 'E';
        } else {
            $grade = 'F';
        }

        $data = ExamResult::create([
            'student_id' => $validated['student_id'],
            'exam_id' => $validated['exam_id'],
            'score' => $validated['score'],
            'grade' => $grade
        ]);
        // Check if both user and class exist
        if ($data) {
            // Set success message
            return redirect()->route('examResults.index')->with('success', 'Congrat!You have create done.');
        } else {
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry?You have created failed.');
        }
    }

    public function edit(ExamResult $examResult)
    {
        $students = Student::all();
        $exams = Exam::all();
        return view('exam_results.edit', compact('exams', 'students', 'examResult'));
    }

    public function update(Request $request, ExamResult $exam)
    {
        $validated = $request->validate([
            'student_id' => 'required',
            'exam_id' => 'required',
            'score' => 'required',
        ]);

        $avgGrade = $validated['score'];
        $grade = '';
        if ($avgGrade >= 100) {
            return redirect()->route('exam_results.edit')->with('error', 'Sorry? Score must be less than 100%.');
        } else if ($avgGrade >= 90) {
            $grade = 'A';
        } elseif ($avgGrade >= 80) {
            $grade = 'B';
        } elseif ($avgGrade >= 70) {
            $grade = 'C';
        } elseif ($avgGrade >= 60) {
            $grade = 'D';
        } elseif ($avgGrade >= 50) {
            $grade = 'E';
        } else {
            $grade = 'F';
        }

        $data = $exam->update([
            'student_id' => $validated['student_id'],
            'exam_id' => $validated['exam_id'],
            'score' => $validated['score'],
            'grade' => $grade
        ]);

        if ($data) {
            // Set success message
            return redirect()->route('examResults.index')->with('success', 'Congrat!You have edited done.');
        } else {
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry?You can not edited at these table.');
        }
    }

    public function destroy(ExamResult $exam)
    {
        $data = $exam->delete();
        if ($data) {
            // Set success message
            return redirect()->route('examResults.index')->with('success', 'Congrat!You have deleted done.');
        } else {
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry?You can not deleted at these table.');
        }
    }
}
