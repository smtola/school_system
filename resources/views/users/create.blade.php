@extends('layouts.app')

@section('title', 'Add Users')

@section('content')
<form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @component('components.alert')
    @endcomponent
    <div class="mb-4">
        <label class="block text-gray-700">User Name</label>
        <input type="text" name="name" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Email</label>
        <input type="email" name="email" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Password</label>
        <input type="password" name="password" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Role</label>
        <select name="role" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Role</option>
            <option value="admin">Admin</option>
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
        </select>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Save</button>
</form>
@endsection
