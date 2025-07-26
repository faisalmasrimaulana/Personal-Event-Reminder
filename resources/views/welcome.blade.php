<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - Personal Reminder</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#ededec] min-h-screen flex items-center justify-center px-6 py-10">

    <div class="max-w-2xl w-full flex flex-col items-center text-center gap-6">
        <!-- Icon -->
        <div class="text-blue-600 text-6xl lg:text-7xl animate-bounce">
            <i class="fa-solid fa-list-check"></i>
        </div>

        <!-- Title -->
        <h1 class="text-3xl lg:text-5xl font-bold leading-tight">
            Selamat Datang di <span class="text-blue-600">Personal Reminder</span>
        </h1>

        <!-- Subtitle -->
        <p class="text-base lg:text-lg text-gray-600 dark:text-gray-300">
            Buat hidupmu lebih terorganisir ✨<br class="hidden lg:inline">
            Catat jadwal penting dan dapatkan pengingat tepat waktu.
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mt-4">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition text-sm font-semibold">
                    <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition text-sm font-semibold">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i> Masuk
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 transition text-sm font-semibold">
                        <i class="fa-solid fa-user-plus mr-2"></i> Daftar
                    </a>
                @endif
            @endauth
        </div>
    </div>

</body>
</html>
