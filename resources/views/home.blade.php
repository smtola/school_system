@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="flex justify-center h-screen">
    <!-- Main content -->
    <div class="flex-1 p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Exam Results Card -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Exam Results</h2>
                <div class="space-y-2">
                    @foreach($results as $result)
                    <div class="flex justify-between">
                        <span class="font-medium">{{ $result->subject }}</span>
                        <span class="font-medium
                                @if($result->grade == 'A')
                                    text-green-600 bg-green-700/40 p-2 rounded-full
                                @elseif($result->grade == 'B')
                                    text-green-600 bg-green-700/40 p-2 rounded-full
                                @elseif($result->grade == 'C')
                                text-green-600 bg-green-700/40 p-2 rounded-full
                                @elseif($result->grade == 'D')
                                text-green-600 bg-green-700/40 p-2 rounded-full
                                @elseif($result->grade == 'E')
                                text-yellow-700 bg-yellow-700/40 p-2 rounded-full
                                @else
                                    text-red-600 bg-red-600/40 p-2 rounded-full
                                @endif
                            ">
                            {{ $result->grade }}
                        </span>
                    </div>
                    @endforeach
                </div>
                <a href="#" class="text-blue-600 hover:underline mt-4 inline-block">View All Results</a>
            </div>

            <!-- Attendance Card -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Attendance</h2>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="font-medium">Present</span>
                        <span class="font-medium text-green-600">{{ $present }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Absent</span>
                        <span class="font-medium text-red-600">{{ $absent }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Late</span>
                        <span class="font-medium text-yellow-600">{{ $late }}</span>
                    </div>
                </div>
                <a href="#" class="text-blue-600 hover:underline mt-4 inline-block">View Full Attendance</a>
            </div>
        </div>
    </div>
</div>
@endsection
