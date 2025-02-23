@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<form action="{{ route('fees.update', $fee->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PUT')
    @component('components.alert')
    @endcomponent
    <div class="mb-4">
        <label class="block text-gray-700">Student Name</label>
        <select name="student_id" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Student</option>
            @foreach($students as $student)
            <option value="{{ $student->id }}" {{ $student->id == $fee->student_id ? 'selected' :'' }}>{{
                $student->user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Status</label>
        <select name="status" class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
            <option selected>Select Status</option>
            <option value="pending" {{ $fee->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ $fee->status == 'paid' ? 'selected' : '' }}>Paid</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Amount</label>
        <input type="number" name="amount" value="{{ $fee->amount }}"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Due Date</label>
        <input type="date" name="due_date" value="{{ $fee->due_date }}"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Payment Date</label>
        <input type="date" name="payment_date" value="{{ $fee->payment_date }}"
            class="bg-gray-200 text-gray-800 w-full p-2 border border-gray-300 rounded-md">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Update</button>
</form>
@endsection