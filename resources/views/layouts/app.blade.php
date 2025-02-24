<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'School Management System')</title>
    {{-- sweet alert --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-blue-800 text-white flex flex-col justify-between">
            <div >
                <h2 class="text-2xl font-bold p-5">School Admin</h2>
                @if(Auth::user()->role == 'admin')
                    <ul class="mt-5">
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('users.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('users.index') }}" class="hover:text-gray-300 flex items-center space-x-2">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                                        <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                                        <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                                    </svg>
                                </span>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('dashboard') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('dashboard') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M3 3v18h18"></path>
                                        <path d="M9 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M13 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M18 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M21 3l-6 1.5"></path>
                                        <path d="M14.113 6.65l2.771 3.695"></path>
                                        <path d="M16 12.5l-5 2"></path>
                                    </svg>
                                </span>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('teachers.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('teachers.index') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                                </span>
                                <p>
                                    Teacher
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('schoolClass.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('schoolClass.index') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"></path>
                                        <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"></path>
                                    </svg>
                                </span>
                                <p>
                                    Class
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('students.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('students.index') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                        <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                        <path d="M9 8h6"></path>
                                    </svg>
                                </span>
                                <p>
                                    Student
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('exams.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('exams.index') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M3.5 5.5l1.5 1.5l2.5 -2.5"></path>
                                        <path d="M3.5 11.5l1.5 1.5l2.5 -2.5"></path>
                                        <path d="M3.5 17.5l1.5 1.5l2.5 -2.5"></path>
                                        <path d="M11 6l9 0"></path>
                                        <path d="M11 12l9 0"></path>
                                        <path d="M11 18l9 0"></path>
                                    </svg>
                                </span>
                                <p>
                                    Exam
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('examResults.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('examResults.index') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path>
                                        <path d="M18 14v4h4"></path>
                                        <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2"></path>
                                        <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                        <path d="M8 11h4"></path>
                                        <path d="M8 15h3"></path>
                                    </svg>
                                </span>
                                <p>
                                    Exam Result
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('attendances.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('attendances.index') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4"></path>
                                        <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                        <path d="M15 3v4"></path>
                                        <path d="M7 3v4"></path>
                                        <path d="M3 11h16"></path>
                                        <path d="M18 16.496v1.504l1 1"></path>
                                    </svg>
                                </span>
                                <p>
                                    Attendance
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('fees.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('fees.index') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path
                                            d="M17.1 8.648a.568 .568 0 0 1 -.761 .011a5.682 5.682 0 0 0 -3.659 -1.34c-1.102 0 -2.205 .363 -2.205 1.374c0 1.023 1.182 1.364 2.546 1.875c2.386 .796 4.363 1.796 4.363 4.137c0 2.545 -1.977 4.295 -5.204 4.488l-.295 1.364a.557 .557 0 0 1 -.546 .443h-2.034l-.102 -.011a.568 .568 0 0 1 -.432 -.67l.318 -1.444a7.432 7.432 0 0 1 -3.273 -1.784v-.011a.545 .545 0 0 1 0 -.773l1.137 -1.102c.214 -.2 .547 -.2 .761 0a5.495 5.495 0 0 0 3.852 1.5c1.478 0 2.466 -.625 2.466 -1.614c0 -.989 -1 -1.25 -2.886 -1.954c-2 -.716 -3.898 -1.728 -3.898 -4.091c0 -2.75 2.284 -4.091 4.989 -4.216l.284 -1.398a.545 .545 0 0 1 .545 -.432h2.023l.114 .012a.544 .544 0 0 1 .42 .647l-.307 1.557a8.528 8.528 0 0 1 2.818 1.58l.023 .022c.216 .228 .216 .569 0 .773l-1.057 1.057z">
                                        </path>
                                    </svg>
                                </span>
                                <p>
                                    Fee
                                </p>
                            </a>
                        </li>
                    </ul>
                @elseif(Auth::user()->role == 'teacher')
                    <ul class="mt-5">
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('dashboard') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('dashboard') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M3 3v18h18"></path>
                                        <path d="M9 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M13 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M18 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M21 3l-6 1.5"></path>
                                        <path d="M14.113 6.65l2.771 3.695"></path>
                                        <path d="M16 12.5l-5 2"></path>
                                    </svg>
                                </span>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('teachers.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('teachers.index') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                                </span>
                                <p>
                                    Teacher
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('exams.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('exams.index') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M3.5 5.5l1.5 1.5l2.5 -2.5"></path>
                                        <path d="M3.5 11.5l1.5 1.5l2.5 -2.5"></path>
                                        <path d="M3.5 17.5l1.5 1.5l2.5 -2.5"></path>
                                        <path d="M11 6l9 0"></path>
                                        <path d="M11 12l9 0"></path>
                                        <path d="M11 18l9 0"></path>
                                    </svg>
                                </span>
                                <p>
                                    Exam
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('examResults.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('examResults.index') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path>
                                        <path d="M18 14v4h4"></path>
                                        <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2"></path>
                                        <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                        <path d="M8 11h4"></path>
                                        <path d="M8 15h3"></path>
                                    </svg>
                                </span>
                                <p>
                                    Exam Result
                                </p>
                            </a>
                        </li>
                        <li
                            class="py-2 p-3 w-full hover:border-r-4 rounded-sm hover:bg-blue-600 hover:border-red-500 transition-all duration-300 {{ Route::is('attendances.index') ? 'bg-blue-600 border-r-4 border-red-500 ' : '' }}">
                            <a href="{{ route('attendances.index') }}" class="hover:text-gray-300 flex items-center space-x-2"><span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                        <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4"></path>
                                        <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                        <path d="M15 3v4"></path>
                                        <path d="M7 3v4"></path>
                                        <path d="M3 11h16"></path>
                                        <path d="M18 16.496v1.504l1 1"></path>
                                    </svg>
                                </span>
                                <p>
                                    Attendance
                                </p>
                            </a>
                        </li>
                    </ul>
                    @endif
            </div>
            <div class="p-5">
                {{--log out button --}}
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center space-x-3 rounded-sm bg-blue-600 border border-current px-8 py-3 text-sm font-medium text-gray-100 transition hover:scale-110 hover:rotate-2 focus:ring-3 focus:outline-hidden">
                        <span>
                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                <path d="M9 12h12l-3 -3"></path>
                                <path d="M18 15l3 -3"></path>
                                </svg>
                        </span>
                        <p>
                            Logout
                        </p>
                    </button>
                </form>

            </div>
        </div>

        <!-- Main Content -->

            <div class="flex-1 p-6">
                <h1 class="text-3xl font-bold mb-5">@yield('title')</h1>
                @yield('content')
            </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>
