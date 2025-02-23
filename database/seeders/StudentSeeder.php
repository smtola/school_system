<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use App\Models\SchoolClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get an existing user (assuming students exist)
        // Fetch the first student user and the first class
        $user = User::where('role', 'student')->first(); // Get a student
        $class = SchoolClass::first(); // Get the first class

        if ($user && $class) {
            // Seed Student with valid user_id and class_id
            Student::create([
                'user_id' => $user->id,
                'class_id' => $class->id,
                'parent_name' => 'John Doe',
                'parent_contact' => '123-456-7890',
                'date_of_birth' => '2005-06-15',
            ]);
        }

        // Add more students as needed
    }
}
