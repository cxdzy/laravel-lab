<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable Details | Minimalist Management</title>
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

<div class="max-w-2xl mx-auto px-4 py-12">
    <!-- Navigation & Header -->
    <header class="mb-10">
        <div class="flex justify-between items-start mb-6">
            <a href="{{ route('timetables.index') }}" class="group flex items-center text-sm text-gray-400 hover:text-black dark:hover:text-white transition-colors">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to list
            </a>
            <button onclick="toggleTheme()" class="p-2 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition-colors focus:outline-none">
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z"></path></svg>
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
        </div>
        <h1 class="text-3xl font-light tracking-tight text-gray-900 dark:text-white">Timetable Details</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Detailed view of schedule entry ID: {{ str_pad($timetable->id, 4, '0', STR_PAD_LEFT) }}</p>
    </header>

    <!-- Details Card -->
    <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl shadow-sm overflow-hidden">
        <div class="p-8 lg:p-10">
            <div class="space-y-10">
                <!-- Hero Info: Subject, Student & Lecturer -->
                <div class="flex items-start space-x-4">
                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-2xl">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Subject</label>
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white leading-tight">
                            {{ optional($timetable->subject)->subject_name }}
                        </h2>
                        <div class="mt-2 space-y-1">
                            <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Student: {{ optional($timetable->user)->name }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Lecturer: {{ optional($timetable->subject)->lecturer_name }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Schedule Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-8 border-y border-gray-50 dark:border-gray-800">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Occurrence</label>
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <span class="bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-full text-xs font-medium">
                                {{ optional($timetable->day)->day_name }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Time Slot</label>
                        <div class="flex items-center text-gray-700 dark:text-gray-300 font-mono text-sm">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $timetable->time_from }} — {{ $timetable->time_to }}
                        </div>
                    </div>
                </div>

                <!-- Logistics Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex flex-col">
                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Venue</label>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ optional($timetable->hall)->lecture_hall_name }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Student Group</label>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ optional($timetable->lecturerGroup)->name }}</span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-10 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('timetables.edit', $timetable->id) }}" 
                       class="btn-transition flex-1 bg-black dark:bg-white text-white dark:text-black py-4 rounded-2xl font-medium text-sm text-center shadow-lg shadow-black/5 dark:shadow-none hover:bg-gray-800 dark:hover:bg-gray-100">
                        Edit Schedule
                    </a>
                    <a href="{{ route('timetables.index') }}" 
                       class="btn-transition flex-1 bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-400 py-4 rounded-2xl font-medium text-sm text-center hover:bg-gray-100 dark:hover:bg-gray-700">
                        Return to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-12 text-center">
        <p class="text-xs text-gray-400 dark:text-gray-600 uppercase tracking-widest font-medium">&copy; {{ date('Y') }} Timetable Management</p>
    </footer>
</div>

</body>
</html>