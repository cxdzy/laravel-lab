<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Minimalist Management</title>
    <!-- Modern Sans-Serif Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Configure Tailwind to use the 'class' strategy for dark mode
        window.tailwind.config = {
            darkMode: 'class',
        };

        // Initialize theme on page load
        (function() {
            try {
                if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {}
        })();

        // Function to toggle theme
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

<div class="max-w-6xl mx-auto px-6 py-12">
    <!-- Top Navigation -->
    <header class="flex justify-between items-center mb-16">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-black dark:bg-white rounded-xl flex items-center justify-center">
                <span class="text-white dark:text-black font-bold text-lg">M</span>
            </div>
            <div>
                <h1 class="text-xl font-semibold tracking-tight">Management Central</h1>
                <p class="text-xs text-gray-500 uppercase tracking-widest font-medium">Dashboard</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <button onclick="toggleTheme()" class="p-2.5 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition-colors focus:outline-none">
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z"></path></svg>
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
            <form method="POST" action="/logout" class="inline">
                @csrf
                <button type="submit" class="text-sm font-semibold text-gray-500 hover:text-red-500 transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Welcome Hero -->
    <div class="mb-12">
        <h2 class="text-4xl md:text-5xl font-light tracking-tight mb-2">
            Welcome, <span class="font-semibold">{{ auth()->user()->name }}</span>
        </h2>
        <p class="text-gray-500 dark:text-gray-400 text-lg font-light">What would you like to manage today?</p>
    </div>

    <!-- Navigation Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Timetables (Primary) -->
        <a href="{{ route('timetables.index') }}" class="card-hover group p-8 bg-black dark:bg-white rounded-3xl shadow-xl shadow-black/10">
            <div class="flex justify-between items-start mb-12">
                <div class="p-3 bg-white/10 dark:bg-black/5 rounded-2xl">
                    <svg class="w-6 h-6 text-white dark:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <svg class="w-5 h-5 text-white/50 dark:text-black/30 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </div>
            <h3 class="text-xl font-medium text-white dark:text-black mb-1">Timetables</h3>
            <p class="text-white/60 dark:text-black/50 text-sm">Schedule orchestration</p>
        </a>

        <!-- Students -->
        <a href="{{ route('students.index') }}" class="card-hover group p-8 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl shadow-sm">
            <div class="flex justify-between items-start mb-12">
                <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl text-gray-400 group-hover:text-black dark:group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <svg class="w-5 h-5 text-gray-300 dark:text-gray-700 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </div>
            <h3 class="text-xl font-medium mb-1">Students</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Profiles & records</p>
        </a>

        <!-- Subjects -->
        <a href="{{ route('subjects.index') }}" class="card-hover group p-8 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl shadow-sm">
            <div class="flex justify-between items-start mb-12">
                <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl text-gray-400 group-hover:text-black dark:group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <svg class="w-5 h-5 text-gray-300 dark:text-gray-700 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </div>
            <h3 class="text-xl font-medium mb-1">Subjects</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Course catalog</p>
        </a>

        <!-- Halls -->
        <a href="{{ route('halls.index') }}" class="card-hover group p-8 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl shadow-sm">
            <div class="flex justify-between items-start mb-12">
                <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl text-gray-400 group-hover:text-black dark:group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <svg class="w-5 h-5 text-gray-300 dark:text-gray-700 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </div>
            <h3 class="text-xl font-medium mb-1">Lecture Halls</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Campus venues</p>
        </a>

        <!-- Groups -->
        <a href="{{ route('lecturer-groups.index') }}" class="card-hover group p-8 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl shadow-sm">
            <div class="flex justify-between items-start mb-12">
                <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl text-gray-400 group-hover:text-black dark:group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <svg class="w-5 h-5 text-gray-300 dark:text-gray-700 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </div>
            <h3 class="text-xl font-medium mb-1">Lecturer Groups</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Faculty organization</p>
        </a>

        <!-- Days -->
        <a href="{{ route('days.index') }}" class="card-hover group p-8 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl shadow-sm">
            <div class="flex justify-between items-start mb-12">
                <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl text-gray-400 group-hover:text-black dark:group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <svg class="w-5 h-5 text-gray-300 dark:text-gray-700 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </div>
            <h3 class="text-xl font-medium mb-1">Days</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Calendar configuration</p>
        </a>
    </div>

    <footer class="mt-20 pt-8 border-t border-gray-100 dark:border-gray-900 flex flex-col md:flex-row justify-between items-center text-[10px] text-gray-400 dark:text-gray-600 uppercase tracking-widest font-bold">
        <p>&copy; {{ date('Y') }} Academic Management System</p>
        <div class="mt-4 md:mt-0 space-x-6">
            <a href="#" class="hover:text-black dark:hover:text-white transition-colors">Privacy</a>
            <a href="#" class="hover:text-black dark:hover:text-white transition-colors">Support</a>
        </div>
    </footer>
</div>

</body>
</html>