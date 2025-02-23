<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ensure there are users with the 'teacher' role
        $users = User::where('role', 'teacher')->get();  // Get all teachers

        // If no teachers exist, create some dummy users and assign them as teachers
        if ($users->isEmpty()) {
            $users = collect([
                User::create([
                    'name' => 'Alice Johnson',
                    'email' => 'alice.johnson@example.com',
                    'password' => bcrypt('password123'),
                    'role' => 'teacher',
                ]),
                User::create([
                    'name' => 'Bob Lee',
                    'email' => 'bob.lee@example.com',
                    'password' => bcrypt('password123'),
                    'role' => 'teacher',
                ]),
                User::create([
                    'name' => 'Charlie Davis',
                    'email' => 'charlie.davis@example.com',
                    'password' => bcrypt('password123'),
                    'role' => 'teacher',
                ]),
            ]);
        }

        // Seed teachers with associated user_id, subject, and contact
        foreach ($users as $user) {
            Teacher::create([
                'user_id' => $user->id,
                'subject' => $this->getRandomSubject(),  // Random subject method
                'contact' => $this->generateRandomContact(),  // Random contact number method
            ]);
        }
    }

    // Randomly generate a subject for a teacher
    private function getRandomSubject()
    {
        $subjects = ['Math', 'Science', 'English', 'History', 'Geography'];
        return $subjects[array_rand($subjects)];
    }

    // Generate a random contact number for a teacher
    private function generateRandomContact()
    {
        return '123-456-' . rand(1000, 9999);
    }
}
