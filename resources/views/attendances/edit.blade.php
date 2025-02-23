@extends('layouts.app')

@section('title', 'Edit Attendance')

@section('content')
<form action="{{ route('attendances.update', $attendance->id) }}" method="POST"
    class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PUT')
    @component('components.alert')
    @endcomponent
    <div class="mb-4">
        <label class="block text-gray-700">Student Name</label>
        <select name="student_id" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Student</option>
            @foreach($students as $student)
            <option value="{{ $student->id }}" {{ $student->id === $attendance->student_id ? 'selected':'' }}>{{
                $student->user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Status</label>
        <select name="status" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Status</option>
            <option value="present" {{ $attendance->status == 'present'? 'selected':'' }}>Present</option>
            <option value="late" {{ $attendance->status == 'late'? 'selected':'' }}>Late</option>
            <option value="absent" {{ $attendance->status == 'absent'? 'selected':'' }}>Absent</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Date</label>
        <input type="date" name="date" value="{{ $attendance->date }}"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Update</button>
</form>
@endsection