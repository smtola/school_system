@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<form action="{{ route('students.update', $student->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PUT')
    @component('components.alert')
    @endcomponent
    <div class="mb-4">
        <label class="block text-gray-700">Student's Name</label>
        <select name="user_id" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Student's Name</option>
            @foreach($user as $users)
            @if($users->role === 'student')
            <option value="{{ $users->id }}" {{ $student->user_id == $users->id ? 'selected' : '' }}>{{ $users->name
                }}({{$users->role}})</option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Parent Name</label>
        <input type="text" name="parent_name" value="{{ $student->parent_name }}"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Parent Contact</label>
        <input type="number" name="parent_contact" value="{{ $student->parent_contact }}"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Date of birth</label>
        <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Class</label>
        <select name="class_id" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Class</option>
            @foreach($classes as $class)
            <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Update</button>
</form>
@endsection