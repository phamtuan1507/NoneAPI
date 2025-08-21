<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

</head>

<body>
    <div class="wrapper @yield('page')">
        @section('header')
            @include('layouts.header')
        @show
        @if (session('success'))
            <div id="success-message"
                class="fixed bottom-4 left-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 relative overflow-hidden z-100"
                style="max-width: 300px;">
                <span class="block">{{ session('success') }}</span>
                <div id="success-countdown"
                    class="absolute bottom-0 left-0 h-1 bg-green-500 transition-all duration-500 ease-linear"
                    style="width: 100%;"></div>
            </div>
        @endif

        @if ($errors->any() || session('error'))
            <div id="error-message"
                class="fixed bottom-4 left-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 relative overflow-hidden z-100"
                style="max-width: 300px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    @if (session('error'))
                        <li>{{ session('error') }}</li>
                    @endif
                </ul>
                <div id="error-countdown"
                    class="absolute bottom-0 left-0 h-1 bg-red-500 transition-all duration-300 ease-linear"
                    style="width: 100%;"></div>
            </div>
        @endif

        @yield('content')
        @yield('scripts')
        @yield('styles')
        @section('footer')
            @include('layouts.footer')
        @show
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Success message
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            const successCountdown = document.getElementById('success-countdown');
            let successWidth = 100;
            const successInterval = setInterval(() => {
                successWidth -= 100 / 50;
                successCountdown.style.width = `${successWidth}%`;
                if (successWidth <= 0) {
                    clearInterval(successInterval);
                    successMessage.classList.add('opacity-0');
                    setTimeout(() => successMessage.style.display = 'none', 500);
                }
            }, 100);
            setTimeout(() => successMessage.classList.add('opacity-0'), 5000);
            setTimeout(() => successMessage.style.display = 'none', 5500);
        }

        // Error message
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            const errorCountdown = document.getElementById('error-countdown');
            let errorWidth = 100;
            const errorInterval = setInterval(() => {
                errorWidth -= 100 / 30;
                errorCountdown.style.width = `${errorWidth}%`;
                if (errorWidth <= 0) {
                    clearInterval(errorInterval);
                    errorMessage.classList.add('opacity-0');
                    setTimeout(() => errorMessage.style.display = 'none', 300);
                }
            }, 100);
            setTimeout(() => errorMessage.classList.add('opacity-0'), 3000);
            setTimeout(() => errorMessage.style.display = 'none', 3300);
        }
    });
</script>
@stack('scripts')

</html>
