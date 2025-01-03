<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Data Produksi - PT. Cocoindo Sukses Abadi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .background-image {
            background-image: url('{{ asset("img/cocohalaman.jpeg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .header-link {
            font-size: 16px;
           
            color: white;
            transition: color 0.3s;
        }
        .header-link:hover {
            color: #d1d5db; /* Warna abu-abu terang saat hover */
        }
        .hero-text {
            font-size: 28px;
            font-weight: 700;
            color: white;
            text-shadow: 1px 2px 6px rgba(0, 0, 0, 0.5);
            line-height: 1.2;
            transform: translateX(-22px) !important;
        }
    </style>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <!-- Background Image -->
    <div class="background-image relative">
        <div class="overlay"></div>
        <div class="relative min-h-screen flex flex-col">
            <!-- Header -->
            <header class="flex justify-between items-center py-5 px-10 relative z-10">
                <!-- Logo di Kiri -->
                <div class="flex items-center gap-4">
                    <img src="{{asset('img/logo_putih.png')}}" alt="Cocoindo Logo" class="h-12 w-14">
                </div>

    
                <!-- Login dan Register di Kanan -->
                <div class="flex gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="header-link">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="header-link">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="header-link">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </header>

            <!-- Hero Section -->
            <div class="flex flex-col items-center justify-center text-center min-h-[calc(100vh-80px)] flex-grow px-6 relative z-10">
                <div class="flex flex-col items-center justify-start min-h-[calc(100vh-300px)] mt-[-50px]">
                    <h2 class="hero-text">
                        Sistem Data Produksi <br> PT. Cocoindo Abadi Sukses
                    </h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
