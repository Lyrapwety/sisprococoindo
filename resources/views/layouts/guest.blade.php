<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cocoindo') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    body {
        color: #636362;
    }
    .custom-button {
        width: 100%; /* Lebar tombol 100% dari kontainer form */
        padding: 10px;
        border: none;
        border-radius: 10px;
        background-color: #104367; /* Warna latar belakang tombol */
        color: white; /* Warna teks tombol */
        cursor: pointer; /* Menunjukkan bahwa tombol dapat diklik */
        font-size: 14px;
    }
    .custom-button:hover{
        background-color: #3c79c9;
    }
    .text-custom {
    color: #636362;
    font: 14px !important;
}

</style>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Left Section -->
        <div class="w-1/2 h-full">
            <img src="img/cocoindo-factory-door-1536x1152.jpeg" alt="Person Working" class="object-cover w-full h-full opacity-80">
        </div>

        <!-- Right Section -->
        <div class="flex items-center justify-center w-1/2 bg-white">
            <div class="w-full max-w-md p-6">
                <img src="img/logonobackground.png" alt="Cocoindo Logo" class="mx-auto mb-4 w-20 h-15">
                <h1 class="text-center mb-4 text-l font-semibold text-gray-700">SISTEM DATA PRODUKSI<br>PT. COCOINDO ABADI SUKSES</h1>

                <!-- Slot untuk konten tambahan (Login/Register Form) -->
                <div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
