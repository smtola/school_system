<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function calculateAttendancePercentage($studentId)
    {
        // Get the student and their attendance records
        $student = Student::find($studentId);
        $totalClasses = $student->attendance->count(); // Total number of attendances

        if ($totalClasses == 0) {
            return 0; // Prevent division by zero if no attendance records exist
        }

        // Count the number of 'Present' statuses
        $presentClasses = $student->attendance->where('status', 'present')->count();

        // Calculate the attendance percentage
        $attendancePercentage = ($presentClasses / $totalClasses) * 100;

        return round($attendancePercentage, 2); // Return the percentage rounded to 2 decimal places
    }

    public function updateAttendancePercentage($studentId)
    {
        // Get the student's attendance records
        $student = Student::find($studentId);
        $totalClasses = $student->attendance->count(); // Total number of attendances recorded

        // If there are no attendance records, we cannot calculate the percentage
        if ($totalClasses == 0) {
            return;
        }

        // Count the number of 'Present' statuses
        $presentClasses = $student->attendance->where('status', 'present')->count();

        // Calculate the attendance percentage
        $attendancePercentage = ($presentClasses / $totalClasses) * 100;

        // Update the attendance percentage for all records of the student
        Attendance::where('student_id', $studentId)->update([
            'attendance_percentage' => round($attendancePercentage, 2)
        ]);
    }

    public function index(Request $request)
    {
        $query = Attendance::query();

        // Search, filter, and sort
        if ($request->has('search')) {
            $query->where('status', 'like', '%' . $request->input('search') . '%');
        }

        // Allowed sorting columns
        $allowedColumns = ['date', 'status', 'attendance_percentage'];
        $sortBy = $request->input('sort_by');

        if (in_array($sortBy, $allowedColumns)) {
            $sortOrder = $request->input('sort_order', 'asc'); // Default to ascending
            $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc'; // Ensure valid order

            $query->orderBy($sortBy, $sortOrder);
        }

        $attendances = $query->paginate(10);
        $noResults = $attendances->isEmpty();
        // Calculate attendance percentage for each student
        foreach ($attendances as $attendance) {
            $attendance->attendance_percentage = $this->calculateAttendancePercentage($attendance->student_id);
        }
        return view('attendances.index', compact('attendances', 'noResults'));
    }

    public function create()
    {
        $students = Student::all();
        return view('attendances.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required',
            'date' => 'required|date',
            'status' => 'required',
        ]);

        $data = Attendance::create($validated);
        // Calculate the attendance percentage for the specific student
        $this->updateAttendancePercentage($data->student_id);
        if ($data) {
            // Set success message
            return redirect()->route('attendances.index')->with('success', 'Congrat!You have create done.');
        } else {
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry? You have created failed.');
        }
    }

    public function edit(Attendance $attendance)
    {
        $students = Student::all();
        return view('attendances.edit', compact('attendance','students'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'student_id' => 'required',
            'date' => 'required|date',
            'status' => 'required'
        ]);

        $data = $attendance->update($validated);
        // Recalculate the attendance percentage
        $this->updateAttendancePercentage($attendance->student_id);

        if ($data) {
            // Set success message
            return redirect()->route('attendances.index')->with('success', 'Congrat!You have update done.');
        } else {
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry? You have updated failed.');
        }
    }

    public function destroy(Attendance $attendance)
    {
        $data = $attendance->delete();

        if ($data) {
            // Set success message
            return redirect()->route('attendances.index')->with('success', 'Congrat!You have update done.');
        } else {
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry? You have updated failed.');
        }
    }
}
