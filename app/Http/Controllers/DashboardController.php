<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Exam;
use App\Models\ExamResult;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsCount = Student::count();
        $teachersCount = Teacher::count();
        $examsCount = Exam::count();
        $examResultsCount = ExamResult::count();
        $upcomingExamsCount = Exam::where('exam_date', '>', now())->count();
        $attendanceStats = Attendance::sum('attendance_percentage');
        $announcements = Announcement::latest()->take(5)->get();
        return view('dashboard', compact(
            'studentsCount',
            'teachersCount',
            'examsCount',
            'examResultsCount',
            'upcomingExamsCount',
            'attendanceStats',
            'announcements'
        ));
    }
}
