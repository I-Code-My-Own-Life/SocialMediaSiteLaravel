<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Larabook</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <div id="app">
        @auth
            <div id="userId" data-user-id="{{ auth()->user()->id }}"></div>
        @endauth
        {{-- Navbar :  --}}
        <x-navbar />
        {{-- Content :  --}}
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <div id="flash-messages">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
</body>
<script>
    // Toggling notification box : 
    let notBtn = document.querySelector('.notBtn');
    notBtn.addEventListener('click', () => {
        notBtn.classList.toggle('clicked');
    })
    notBtn.addEventListener('mouseleave', () => {
        document.querySelector('.cont').addEventListener('mouseleave', () => {
            notBtn.classList.remove('clicked');
        })
    })
    setTimeout(() => {
        document.getElementById("flash-messages").style.display = 'none';
    }, 5000);
</script>

</html>
