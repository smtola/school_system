@extends('layouts.app')

@section('title', 'Fees')

@section('content')
<div class="mb-4 flex items-center justify-between">
    <form method="GET" action="{{ route('fees.index') }}" class="flex items-center space-x-4">
        <label class="flex items-center px-4 py-2 border border-gray-300 rounded bg-[#ffffff]">
            <input type="text" id="empty" name="search" placeholder="Search status"
                class="outline-none focus:ring-0 bg-[#ffffff] text-gray-800" value="{{ request('search') }}">
            <button type="submit" onclick="onClear()"
                class="rounded-full hover:bg-black/40 transition-all duration-[150] cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                    <path d="M18 6l-12 12"></path>
                    <path d="M6 6l12 12"></path>
                </svg>
            </button>
        </label>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Search</button>
    </form>
    <form id="sortForm" method="GET" action="{{ route('fees.index') }}" class="flex items-center space-x-4">
        <!-- Sort By -->
        <select name="sort_by" class="px-4 py-2 bg-[#ffffff] text-gray-800 border border-gray-300 rounded"
            onchange="document.getElementById('sortForm').submit();">
            <option value="student_id" {{ request('sort_by')=='student_id' ? 'selected' : '' }}>Student</option>
            <option value="amount" {{ request('sort_by')=='amount' ? 'selected' : '' }}>Amount</option>
            <option value="due_date" {{ request('sort_by')=='due_date' ? 'selected' : '' }}>Due Date</option>
            <option value="payment_date" {{ request('sort_by')=='payment_date' ? 'selected' : '' }}>Payment Date</option>
            <option value="status" {{ request('sort_by')=='status' ? 'selected' : '' }}>Status</option>
        </select>

        <!-- Sort Order -->
        <select name="sort_order" class="px-4 py-2 bg-[#ffffff] text-gray-800 border border-gray-300 rounded"
            onchange="document.getElementById('sortForm').submit();">
            <option value="asc" {{ request('sort_order')=='asc' ? 'selected' : '' }}>Asc</option>
            <option value="desc" {{ request('sort_order')=='desc' ? 'selected' : '' }}>Desc</option>
        </select>
    </form>
</div>

<div class="flex justify-between items-center mb-4 !text-gray-800">
    <h1 class="text-2xl font-bold">
        Fees Results</h1>
    @component('components.alert')
    @endcomponent
    <a href="{{ route('fees.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Fees</a>
</div>

<table class="min-w-full bg-white border border-gray-200 !text-gray-800">
    <thead>
        <tr>
            <th class="px-6 py-3 text-left">Student</th>
            <th class="px-6 py-3 text-left">Status</th>
            <th class="px-6 py-3 text-left">Amount</th>
            <th class="px-6 py-3 text-left">Due Date</th>
            <th class="px-6 py-3 text-left">Payment Date</th>
            <th class="px-6 py-3 text-end">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if($noResults)
        <tr class="bg-[#f3f4f6]">
            <td colspan="6">
                <div class="flex items-center justify-center flex-col py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100"
                        height="100" viewBox="0 0 512 512" fill="none">
                        <rect width="512" height="512" fill="url(#pattern0_108_3)" />
                        <defs>
                            <pattern id="pattern0_108_3" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_108_3" transform="scale(0.00195312)" />
                            </pattern>
                            <image id="image0_108_3" width="512" height="512" preserveAspectRatio="none"
                                xlink:href="data:image/png;base64,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AQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIQAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAwEor/X8ibbTGP+LRuwAAAABJRU5ErkJggg==" />
                        </defs>
                    </svg>
                    <p class="text-xl font-semibold text-gray-500 mt-4">Data not found...</p>
                </div>
            </td>
        </tr>
        @else
        @foreach($fees as $fee)
        <tr class="{{ $fee->status == 'pending' ? 'border-l-4 border-red-500 hover:bg-red-500/30': 'border-green-700 border-l-4 hover:bg-green-700/30' }} transition-all duration-150">
            <td class="px-6 py-4">{{ $fee->student->user->name }}</td>
            <td
                class="px-6 py-4 capitalize font-bold {{ $fee->status == 'pending' ? 'text-red-500':'text-green-500' }}">
                <h1
                    class="{{ $fee->status == 'pending' ? 'bg-red-500/30': 'bg-green-500/30' }} w-fit px-5 rounded-full">
                    {{ $fee->status }}
                </h1>
            </td>
            <td class="px-6 py-4 font-bold">${{ number_format($fee->amount,2) }}</td>
            <td class="px-6 py-4 font-bold ">
                {{ \Carbon\Carbon::parse($fee->due_date)->format('d/m/y') }}
            </td>
            <td class="px-6 py-4 font-bold ">
               {{ \Carbon\Carbon::parse($fee->payment_date)->format('d/m/y') }}
            </td>
            <!-- Fetch class name using the relationship -->
            <td class="px-6 py-4">
                <div class="flex space-x-2 justify-end items-center">
                    <a href="{{ route('fees.edit', $fee->id) }}"
                        class="px-4 py-2 hover:bg-[#088bff]/50 rounded-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="#088bff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                        </svg>
                    </a>

                    <button type="button"
                        class="px-4 py-2 hover:bg-red-500/50 rounded-lg text-white btn-delete-reservation"
                        data-id="{{ $fee->id }}" data-name="{{ $fee->student->user->name }}"
                        onclick="openDeleteModal(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="#eb1c25" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                        </svg>
                    </button>

                    <dialog id="deleteModal"
                        class="modal overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="modal-box relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 id="modal-student-name"
                                        class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"></h3>

                                    <div class="flex items-center justify-center">
                                        <form id="delete-form" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center delete-res">
                                                Yes, I'm sure
                                            </button>
                                        </form>
                                        <form method="dialog">
                                            <button
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                No, cancel
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </dialog>
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

<div class="mt-4">
    {{ $fees->links() }}
</div>

<script>
    const onEmpty = document.getElementById('empty');
            const onClear = ()=>{
                onEmpty.value = '';
            }
               function openDeleteModal(button) {
            const studentId = button.getAttribute('data-id');
            const studentName = button.getAttribute('data-name');

            // Update the modal text
            document.getElementById('modal-student-name').innerText = `Are you sure you want to delete ${studentName}?`;

            // Update the delete form action dynamically
            document.getElementById('delete-form').action = `/fees/${studentId}`;

            // Show the modal
            document.getElementById('deleteModal').showModal();
            }
</script>
@endsection
