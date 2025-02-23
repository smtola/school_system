<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Student;
class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        // Check if there are any students
        $student = Student::first();
        // Add some attendance data for the first student
        Attendance::create(['student_id' => $student->id,
            'date' => now(),
            'attendance_percentage' => 95.0,  // Example attendance percentage
            'status' => 'present',
        ]);
    }

}
