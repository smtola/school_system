@extends('layouts.app')

@section('title', 'Add Exam')

@section('content')
<form action="{{ route('exams.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @component('components.alert')
    @endcomponent
    <div class="mb-4">
        <label class="block text-gray-700">Class</label>
        <select name="class_id" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Class</option>
            @foreach($classes as $class)
            <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Subject</label>
        <input type="text" name="subject"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Exam Date</label>
        <input type="date" name="exam_date"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Save</button>
</form>
@endsection