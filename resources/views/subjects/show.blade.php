<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Details | Minimalist Management</title>
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
            <a href="{{ route('subjects.index') }}" class="group flex items-center text-sm text-gray-400 hover:text-black dark:hover:text-white transition-colors">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to subjects
            </a>
            <button onclick="toggleTheme()" class="p-2 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition-colors focus:outline-none">
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z"></path></svg>
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
        </div>
        <h1 class="text-3xl font-light tracking-tight text-gray-900 dark:text-white">Subject Details</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Information for course record ID: {{ str_pad($subject->id, 4, '0', STR_PAD_LEFT) }}</p>
    </header>

    <!-- Details Card -->
    <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-8 lg:p-10">
            <div class="space-y-8">
                <!-- Subject Name (Hero Detail) -->
                <div>
                    <label class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">
                        Subject Name
                    </label>
                    <p class="text-2xl font-medium text-gray-800 dark:text-gray-100 leading-tight">
                        {{ $subject->subject_name }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                    <!-- Code Detail -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">
                            Course Code
                        </label>
                        <div class="inline-flex items-center bg-gray-50 dark:bg-gray-800/50 px-3 py-1.5 rounded-lg border border-gray-100 dark:border-gray-800">
                            <span class="text-sm font-bold font-mono text-gray-600 dark:text-gray-400 tracking-tighter">
                                {{ $subject->subject_code }}
                            </span>
                        </div>
                    </div>

                    <!-- Lecturer Detail -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">
                            Assigned Lecturer
                        </label>
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm font-medium">{{ $subject->lecturer_name }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Actions -->
                <div class="pt-10 border-t border-gray-50 dark:border-gray-800 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('subjects.edit', $subject->id) }}" 
                       class="btn-transition flex-1 bg-black dark:bg-white text-white dark:text-black py-3 rounded-xl font-medium text-sm text-center shadow-lg shadow-black/5 dark:shadow-none hover:bg-gray-800 dark:hover:bg-gray-200">
                        Edit Subject
                    </a>
                    <a href="{{ route('subjects.index') }}" 
                       class="btn-transition flex-1 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 py-3 rounded-xl font-medium text-sm text-center hover:bg-gray-200 dark:hover:bg-gray-700">
                        Return to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-12 text-center">
        <p class="text-xs text-gray-400 dark:text-gray-600 uppercase tracking-widest font-medium">&copy; {{ date('Y') }} Subject Management</p>
    </footer>
</div>

</body>
</html>