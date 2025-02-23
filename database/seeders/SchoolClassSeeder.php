<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */    // Seed School Classes (Example)
    public function run()
    {
        // Seed School Classes (Example)
        SchoolClass::create([
            'name' => 'Math 101',
            'teacher_id' => 1,  // Assuming Teacher with ID 1 exists
        ]);

        SchoolClass::create([
            'name' => 'Science 101',
            'teacher_id' => 2,  // Assuming Teacher with ID 2 exists
        ]);
    }
}
