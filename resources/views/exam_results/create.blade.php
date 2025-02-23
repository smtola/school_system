@extends('layouts.app')

@section('title', 'Add Exam Results')

@section('content')
<form action="{{ route('examResults.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @component('components.alert')
    @endcomponent
    <div class="mb-4">
        <label class="block text-gray-700">Student Name</label>
        <select name="student_id" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Student</option>
            @foreach($students as $student)
            <option value="{{ $student->id }}">{{ $student->user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Subject for Exam</label>
        <select name="exam_id" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Subject for exam</option>
            @foreach($exams as $exam)
            <option value="{{ $exam->id }}">{{ $exam->subject }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Marks</label>
        <input type="number" name="score"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Save</button>
</form>
@endsection