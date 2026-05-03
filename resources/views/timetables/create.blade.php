<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Timetable | Minimalist Management</title>
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
        .input-focus {
            transition: all 0.2s ease;
        }
        .input-focus:focus {
            outline: none;
            border-color: #000;
            box-shadow: 0 0 0 1px #000;
        }
        .dark .input-focus:focus {
            border-color: #fff;
            box-shadow: 0 0 0 1px #fff;
        }
        /* Style for time input clock icon in dark mode */
        .dark input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
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
                Back to timetables
            </a>
            <button onclick="toggleTheme()" class="p-2 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition-colors focus:outline-none">
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z"></path></svg>
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
        </div>
        <h1 class="text-3xl font-light tracking-tight text-gray-900 dark:text-white">Create Timetable</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Schedule a new session by linking users, subjects, and venues.</p>
    </header>

    <!-- Error Handling -->
    @if ($errors->any())
        <div class="mb-8 p-5 bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-800/30 rounded-2xl">
            <div class="flex mb-2">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-sm font-semibold text-red-800 dark:text-red-400">Please review the schedule details:</h3>
            </div>
            <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-400/80 space-y-1 ml-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm p-8 lg:p-10">
        <form action="{{ route('timetables.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- User Select -->
                <div class="md:col-span-2">
                    <label for="user_id" class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">User / Lecturer</label>
                    <select name="user_id" id="user_id" required 
                            class="input-focus w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-xl text-gray-800 dark:text-gray-200 appearance-none">
                        <option value="" disabled selected>Select a user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Subject Select -->
                <div>
                    <label for="subject_id" class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Subject</label>
                    <select name="subject_id" id="subject_id" required 
                            class="input-focus w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-xl text-gray-800 dark:text-gray-200 appearance-none">
                        <option value="" disabled selected>Select subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Day Select -->
                <div>
                    <label for="day_id" class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Day of Week</label>
                    <select name="day_id" id="day_id" required 
                            class="input-focus w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-xl text-gray-800 dark:text-gray-200 appearance-none">
                        <option value="" disabled selected>Select day</option>
                        @foreach($days as $day)
                            <option value="{{ $day->id }}" @selected(old('day_id') == $day->id)>{{ $day->day_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Hall Select -->
                <div>
                    <label for="hall_id" class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Lecture Hall</label>
                    <select name="hall_id" id="hall_id" required 
                            class="input-focus w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-xl text-gray-800 dark:text-gray-200 appearance-none">
                        <option value="" disabled selected>Select hall</option>
                        @foreach($halls as $hall)
                            <option value="{{ $hall->id }}" @selected(old('hall_id') == $hall->id)>{{ $hall->lecture_hall_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Group Select -->
                <div>
                    <label for="lecturer_group_id" class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Lecturer Group</label>
                    <select name="lecturer_group_id" id="lecturer_group_id" required 
                            class="input-focus w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-xl text-gray-800 dark:text-gray-200 appearance-none">
                        <option value="" disabled selected>Select group</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" @selected(old('lecturer_group_id') == $group->id)>{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Time Inputs -->
                <div>
                    <label for="time_from" class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Start Time</label>
                    <input type="time" name="time_from" id="time_from" 
                           value="{{ old('time_from') }}"
                           class="input-focus w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-xl text-gray-800 dark:text-gray-200">
                </div>

                <div>
                    <label for="time_to" class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">End Time</label>
                    <input type="time" name="time_to" id="time_to" 
                           value="{{ old('time_to') }}"
                           class="input-focus w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-xl text-gray-800 dark:text-gray-200">
                </div>
            </div>

            <div class="pt-6 border-t border-gray-50 dark:border-gray-800">
                <button type="submit" 
                        class="btn-transition w-full bg-black hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 dark:text-black text-white py-4 rounded-xl font-medium text-sm shadow-lg shadow-black/5 dark:shadow-none">
                    Save Schedule
                </button>
                <div class="text-center mt-6">
                    <a href="{{ route('timetables.index') }}" class="text-xs text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors uppercase tracking-widest font-semibold">
                        Cancel and return
                    </a>
                </div>
            </div>
        </form>
    </div>

    <footer class="mt-12 text-center">
        <p class="text-xs text-gray-400 dark:text-gray-600 uppercase tracking-widest font-medium">&copy; {{ date('Y') }} Timetable Management</p>
    </footer>
</div>

</body>
</html>