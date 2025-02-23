@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<form action="{{ route('schoolClass.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @component('components.alert')
    @endcomponent
    <div class="mb-4">
        <label class="block text-gray-700">Teacher's Name</label>
        <select name="teacher_id" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Teacher's Name</option>
            @foreach($teacher as $teachers)
            <option value="{{ $teachers->id }}">{{ $teachers->user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Class's Name</label>
        <input type="text" name="name" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Save</button>
</form>
@endsection