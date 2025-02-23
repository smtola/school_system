@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PUT')
    @component('components.alert')
    @endcomponent
    <div class="mb-4">
        <label class="block text-gray-700">User Name</label>
        <input type="text" name="name" value="{{ $user->name }}" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Password</label>
        <input type="password" name="password" value="{{ $user->password }}"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Role</label>
        <select name="role" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Role</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected':'' }}>Admin</option>
            <option value="teacher" {{ $user->role == 'teacher' ? 'selected':'' }}>Teacher</option>
            <option value="student" {{ $user->role == 'student' ? 'selected':'' }}>Student</option>
        </select>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Update</button>
</form>
@endsection
