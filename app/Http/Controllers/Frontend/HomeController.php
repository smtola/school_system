<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ExamResult;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $results = ExamResult::query()
            ->join('exams', 'exams.id', '=', 'exam_results.exam_id')
            ->select('exam_results.*', 'exams.subject as subject', 'exam_results.grade')
            ->orderBy('exam_results.id', 'desc')
            ->get();
        $attendances = Attendance::query();
        $present = $attendances->where('status', 'present')->count();
        $absent = $attendances->where('status', 'absent')->count();
        $late = $attendances->where('status', 'late')->count();
        return view('home', compact('results','present','absent','late'));  // Passing 'results' to the view
    }
}
