@if (Session::has('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "{{ session::get('success') }}"
        });
    </script>
@endif
@if (Session::has('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "error",
            title: "{{ session::get('error') }}"
        });
    </script>
@endif

@if ($errors->any())
    <div class="bg-red-500/30 text-red-500 p-4 rounded-lg flex items-start space-x-[1em]">
    <!-- Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.25">
            <path d="M20.983 12.556a9 9 0 1 0 -8.433 8.427"></path>
            <path d="M9 10h.01"></path>
            <path d="M15 10h.01"></path>
            <path d="M9.5 15c.658 .64 1.56 1 2.5 1c.194 0 .386 -.015 .574 -.045"></path>
            <path d="M21.5 21.5l-5 -5"></path>
            <path d="M16.5 21.5l5 -5"></path>
        </svg>
        
        <!-- Alert Content -->
        <div>
            <h2 class="font-[300] text-xl mb-2">Error</h2>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
