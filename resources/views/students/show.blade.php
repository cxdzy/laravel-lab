<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details | Minimalist Management</title>
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
            <a href="{{ route('students.index') }}" class="group flex items-center text-sm text-gray-400 hover:text-black dark:hover:text-white transition-colors">
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
        <h1 class="text-3xl font-light tracking-tight text-gray-900 dark:text-white">Student Profile</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Detailed overview of record ID: {{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</p>
    </header>

    <!-- Content Card -->
    <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-8 lg:p-10">
            <div class="space-y-10">
                <!-- Name Detail -->
                <div class="flex items-start">
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Full Name</label>
                        <p class="text-2xl font-medium text-gray-800 dark:text-gray-100">{{ $student->name }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 pt-4">
                    <!-- Email -->
                    <div class="flex items-start">
                        <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg mr-3 mt-1">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Email Address</label>
                            <p class="text-sm text-gray-700 dark:text-gray-300 font-medium">{{ $student->email }}</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start">
                        <div class="p-2 bg-green-50 dark:bg-green-900/20 rounded-lg mr-3 mt-1">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Phone Number</label>
                            <p class="text-sm text-gray-700 dark:text-gray-300 font-medium">{{ $student->phone_number ?? 'Not provided' }}</p>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2 flex items-start">
                        <div class="p-2 bg-purple-50 dark:bg-purple-900/20 rounded-lg mr-3 mt-1">
                            <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Physical Address</label>
                            <p class="text-sm text-gray-700 dark:text-gray-300 font-medium leading-relaxed">{{ $student->address ?? 'No address recorded' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="pt-10 border-t border-gray-50 dark:border-gray-800 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('students.edit', $student->id) }}" 
                       class="btn-transition flex-1 bg-black dark:bg-white text-white dark:text-black py-3 rounded-xl font-medium text-sm text-center shadow-lg shadow-black/5 dark:shadow-none hover:bg-gray-800 dark:hover:bg-gray-200">
                        Edit Profile
                    </a>
                    <a href="{{ route('students.index') }}" 
                       class="btn-transition flex-1 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 py-3 rounded-xl font-medium text-sm text-center hover:bg-gray-200 dark:hover:bg-gray-700">
                        Return to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-12 text-center">
        <p class="text-xs text-gray-400 dark:text-gray-600 uppercase tracking-widest font-medium">&copy; {{ date('Y') }} Student Records System</p>
    </footer>
</div>

</body>
</html>