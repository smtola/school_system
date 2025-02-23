@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')
<form action="{{ route('teachers.update', $teacher->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PUT')
    @component('components.alert')
    @endcomponent
    <div class="mb-4">
        <label class="block text-gray-700">Student's Name</label>
        <select name="user_id" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Student's Name</option>
            @foreach($user as $users)
            @if($users->role === 'teacher')
            <option value="{{ $users->id }}" {{ $teacher->user_id == $users->id ? 'selected':'' }}>{{ $users->name
                }}({{$users->role}})</option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Subject</label>
        <input type="text" name="subject" value="{{ $teacher->subject }}"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Contact</label>
        <input type="number" name="contact" value="{{ $teacher->contact }}"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Update</button>
</form>
@endsection