@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@component('components.alert')
@endcomponent
<div class="grid grid-cols-3 gap-6">
    <!-- Total Students -->
    <div class="bg-white p-5 rounded-sm shadow-md border-gray-500 border-l-4">
        <h2 class="text-xl font-semibold">Total Students</h2>
        <p class="text-3xl font-bold">{{ $studentsCount }}</p>
    </div>

    <!-- Total Teachers -->
    <div class="bg-white p-5 rounded-sm shadow-md border-gray-500 border-l-4">
        <h2 class="text-xl font-semibold ">Total Teachers</h2>
        <p class="text-3xl font-bold">{{ $teachersCount }}</p>
    </div>

    <!-- Total Exams -->
    <div class="bg-white p-5 rounded-sm shadow-md border-gray-500 border-l-4">
        <h2 class="text-xl font-semibold">Total Exams</h2>
        <p class="text-3xl font-bold">{{ $examsCount }}</p>
    </div>
</div>

<div class="grid grid-cols-2 gap-6 mt-6">
    <!-- Total Exam Results -->
    <div class="bg-white p-5 rounded-sm shadow-md border-gray-500 border-l-4">
        <h2 class="text-xl font-semibold">Total Exam Results</h2>
        <p class="text-3xl font-bold">{{ $examResultsCount }}</p>
    </div>

    <!-- Upcoming Exams -->
    <div class="bg-white p-5 rounded-sm shadow-md border-gray-500 border-l-4">
        <h2 class="text-xl font-semibold">Upcoming Exams</h2>
        <p class="text-3xl font-bold">{{ $upcomingExamsCount }}</p>
    </div>
</div>

<div class="grid grid-cols-2 gap-6 mt-6">
    <!-- Attendance Stats -->
    <div class="bg-white p-5 rounded-sm shadow-sm border-gray-500 border-l-4">
        <h2 class="text-xl font-semibold">Attendance Stats</h2>
        <p class="text-3xl font-bold">{{ $attendanceStats }}%</p> <!-- Display average attendance percentage -->
    </div>

    <!-- Latest Announcements -->
    <div class="bg-white p-5 rounded-sm shadow-sm border-gray-500 border-l-4">
        <h2 class="text-xl font-semibold">Latest Announcements</h2>
        <ul>
            @foreach ($announcements as $announcement)
            <li class="text-md mb-2">{{ $announcement->title }}</li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
