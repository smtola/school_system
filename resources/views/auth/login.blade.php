@extends('layouts.admin')
@section('content')
<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8 h-screen">
    <div class="mx-auto max-w-lg text-center">
        <h1 class="text-2xl font-bold sm:text-3xl">Login School System!</h1>

        <p class="mt-4 text-gray-500">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Et libero nulla eaque error neque
            ipsa culpa autem, at itaque nostrum!
        </p>
    </div>

   <form action="{{ route('login.post') }}" method="POST" class="mx-auto mt-8 mb-0 max-w-md space-y-4">
    @csrf
    <!-- CSRF token for protection -->

    <div>
        <label for="email" class="sr-only">Email</label>
        <div class="relative">
            <input type="email" name="email" id="email"
                class="w-full rounded-lg bg-gray-200 border-gray-200 p-4 pe-12 text-sm shadow-xs"
                placeholder="Enter email" required />
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                <!-- Icon SVG here -->
            </span>
        </div>
    </div>

    <div>
        <label for="password" class="sr-only">Password</label>
        <div class="relative">
            <input type="password" name="password" id="password"
                class="w-full rounded-lg bg-gray-200 border-gray-200 p-4 pe-12 text-sm shadow-xs"
                placeholder="Enter password" required />
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                <!-- Icon SVG here -->
            </span>
        </div>
    </div>
    @component('components.alert')
    @endcomponent
    <div class="flex items-center justify-between">
        <button type="submit" class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white">
            Sign in
        </button>
    </div>
</form>
</div>
@endsection
