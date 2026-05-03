<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Management System</title>
    <!-- Modern Sans-Serif Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        window.tailwind.config = {
            darkMode: 'class',
        };

        (function() {
            try {
                if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {}
        })();

        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            try {
                localStorage.theme = isDark ? 'dark' : 'light';
            } catch (e) {}
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100 min-h-screen">

    <div class="relative min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="flex justify-between items-center px-6 py-8 md:px-12">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-black dark:bg-white rounded-lg flex items-center justify-center">
                    <span class="text-white dark:text-black font-bold text-xs">M</span>
                </div>
                <span class="text-sm font-semibold tracking-tighter uppercase">System</span>
            </div>
            
            <div class="flex items-center space-x-6">
                @if (Route::has('login'))
                    <div class="hidden sm:flex items-center space-x-6 text-sm font-medium">
                        @auth
                            <a href="{{ url('/home') }}" class="hover:text-gray-500 dark:hover:text-gray-400 transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="hover:text-gray-500 dark:hover:text-gray-400 transition-colors">Sign In</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-black dark:bg-white text-white dark:text-black px-4 py-2 rounded-full hover:bg-gray-800 dark:hover:bg-gray-200 transition-all">Get Started</a>
                            @endif
                        @endauth
                    </div>
                @endif
                
                <button onclick="toggleTheme()" class="p-2 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition-colors focus:outline-none">
                    <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z"></path></svg>
                    <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="flex-grow flex flex-col items-center justify-center px-6 text-center">
            <div class="max-w-3xl">
                <h1 class="text-5xl md:text-7xl font-light tracking-tight text-gray-900 dark:text-white mb-6">
                    Management <span class="font-semibold italic">Redefined.</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-500 dark:text-gray-400 mb-12 leading-relaxed font-light">
                    An academic orchestration platform built for students, lecturers, and campus administrators. 
                    Manage venues, schedules, and records in one minimalist interface.
                </p>
                
                <!-- Quick Access Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full max-w-5xl mx-auto">
                    <!-- Halls -->
                    <a href="{{ route('halls.index') }}" class="card-hover group p-6 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl text-left shadow-sm">
                        <div class="w-10 h-10 bg-gray-50 dark:bg-gray-800 rounded-xl mb-4 flex items-center justify-center text-gray-400 group-hover:text-black dark:group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2