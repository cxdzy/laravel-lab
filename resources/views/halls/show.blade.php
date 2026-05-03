<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Details | Minimalist Management</title>
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
            } catch (e) {
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                }
            }
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
        .btn-transition {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100 min-h-screen">

<div class="max-w-xl mx-auto px-4 py-12">
    <!-- Navigation & Header -->
    <header class="mb-10">
        <div class="flex justify-between items-start mb-6">
            <a href="{{ route('halls.index') }}" class="group flex items-center text-sm text-gray-400 hover:text-black dark:hover:text-white transition-colors">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to halls
            </a>
            <button onclick="toggleTheme()" class="p-2 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition-colors focus:outline-none">
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z"></path></svg>
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
        </div>
        <h1 class="text-3xl font-light tracking-tight text-gray-900 dark:text-white">Hall Details</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Information regarding venue ID: {{ $hall->id }}</p>
    </header>

    <!-- Details Card -->
    <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-8">
            <div class="space-y-8">
                <!-- Name Detail -->
                <div>
                    <label class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">
                        Hall Name
                    </label>
                    <p class="text-xl font-medium text-gray-800 dark:text-gray-100">
                        {{ $hall->lecture_hall_name }}
                    </p>
                </div>

                <!-- Place Detail -->
                <div>
                    <label class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">
                        Location / Place
                    </label>
                    <div class="inline-flex items-center bg-gray-50 dark:bg-gray-800/50 px-4 py-2 rounded-xl">
                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300">{{ $hall->lecture_hall_place }}</span>
                    </div>
                </div>
                
                <!-- Bottom Action Row -->
                <div class="pt-8 border-t border-gray-50 dark:border-gray-800 flex justify-between items-center">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-tighter">Database Reference</p>
                        <p class="text-sm font-mono text-gray-500">{{ str_pad($hall->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('halls.edit', $hall->id) }}" 
                           class="btn-transition bg-black dark:bg-white text-white dark:text-black px-6 py-2 rounded-full text-sm font-medium shadow-sm hover:bg-gray-800 dark:hover:bg-gray-200">
                            Edit Hall
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-12 text-center">
        <p class="text-xs text-gray-400 dark:text-gray-600 uppercase tracking-widest font-medium">&copy; {{ date('Y') }} Venue Management</p>
    </footer>
</div>

</body>
</html>