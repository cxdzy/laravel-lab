<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetables | Minimalist Management</title>
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
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #374151;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 py-12">
    <!-- Header -->
    <header class="flex justify-between items-end mb-10">
        <div>
            <h1 class="text-3xl font-light tracking-tight text-gray-900 dark:text-white">Timetables</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Review and organize academic schedules</p>
        </div>
        <div class="flex items-center space-x-4">
            <!-- Theme Toggle Button -->
            <button onclick="toggleTheme()" class="p-2 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition-colors focus:outline-none">
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z"></path></svg>
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
            <a href="{{ route('timetables.create') }}" 
               class="btn-transition bg-black hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 dark:text-black text-white px-6 py-2.5 rounded-full text-sm font-medium shadow-sm">
                + Create Timetable
            </a>
        </div>
    </header>

    <!-- Success/Error Feedback -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800/30 text-green-700 dark:text-green-400 text-sm rounded-xl flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800/30 text-red-700 dark:text-red-400 text-sm rounded-xl flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Search Section -->
    <div class="mb-8 p-6 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm">
        <form action="{{ route('timetables.index') }}" method="GET">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label for="user_name" class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">User</label>
                    <input type="text" name="user_name" id="user_name" value="{{ request('user_name') }}" placeholder="User name"
                           class="input-focus w-full px-3 py-2 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-lg text-sm text-gray-700 dark:text-gray-200">
                </div>
                <div>
                    <label for="subject_name" class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Subject</label>
                    <input type="text" name="subject_name" id="subject_name" value="{{ request('subject_name') }}" placeholder="Subject"
                           class="input-focus w-full px-3 py-2 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-lg text-sm text-gray-700 dark:text-gray-200">
                </div>
                <div>
                    <label for="day_name" class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Day</label>
                    <input type="text" name="day_name" id="day_name" value="{{ request('day_name') }}" placeholder="Day"
                           class="input-focus w-full px-3 py-2 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-lg text-sm text-gray-700 dark:text-gray-200">
                </div>
                <div>
                    <label for="hall_name" class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Hall</label>
                    <input type="text" name="hall_name" id="hall_name" value="{{ request('hall_name') }}" placeholder="Hall"
                           class="input-focus w-full px-3 py-2 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-lg text-sm text-gray-700 dark:text-gray-200">
                </div>
                <div>
                    <label for="group_name" class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Group</label>
                    <input type="text" name="group_name" id="group_name" value="{{ request('group_name') }}" placeholder="Group"
                           class="input-focus w-full px-3 py-2 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-lg text-sm text-gray-700 dark:text-gray-200">
                </div>
            </div>
            <div class="mt-4 flex justify-end space-x-3">
                <a href="{{ route('timetables.index') }}" class="text-xs text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors uppercase tracking-widest font-semibold flex items-center">
                    Reset
                </a>
                <button type="submit" class="btn-transition bg-black hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 dark:text-black text-white px-5 py-1.5 rounded-full text-xs font-medium">
                    Search
                </button>
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Schedule</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Hall & Group</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @forelse($timetables as $t)
                    <tr class="group hover:bg-gray-50/30 dark:hover:bg-gray-800/30 transition-colors">
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ optional($t->user)->name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ optional($t->subject)->subject_name }}</span>
                                <span class="text-[10px] font-mono text-gray-400 uppercase tracking-tighter">{{ optional($t->subject)->subject_code }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">{{ optional($t->day)->day_name }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-500 font-mono">{{ $t->time_from }} — {{ $t->time_to }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col space-y-1">
                                <span class="inline-flex text-[10px] font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded w-fit">
                                    {{ optional($t->hall)->lecture_hall_name }}
                                </span>
                                <span class="inline-flex text-[10px] font-medium text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/20 px-2 py-0.5 rounded w-fit">
                                    {{ optional($t->lecturerGroup)->name }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-center space-x-1">
                                <a href="{{ route('timetables.show', $t->id) }}" 
                                   class="btn-transition text-gray-400 dark:text-gray-500 hover:text-black dark:hover:text-white p-2 rounded-lg hover:bg-white dark:hover:bg-gray-800 hover:shadow-sm"
                                   title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                
                                <a href="{{ route('timetables.edit', $t->id) }}" 
                                   class="btn-transition text-gray-400 dark:text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 p-2 rounded-lg hover:bg-white dark:hover:bg-gray-800 hover:shadow-sm"
                                   title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>

                                <form action="{{ route('timetables.destroy', $t->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn-transition text-gray-300 dark:text-gray-700 hover:text-red-500 dark:hover:text-red-400 p-2 rounded-lg hover:bg-white dark:hover:bg-gray-800 hover:shadow-sm"
                                            onclick="return confirm('Archive this schedule?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center bg-white dark:bg-gray-900">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-200 dark:text-gray-800 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-gray-400 dark:text-gray-600 text-sm italic">No timetables found.</p>
                                <a href="{{ route('timetables.create') }}" class="mt-4 text-black dark:text-white text-sm font-medium underline">Create your first schedule</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <footer class="mt-12 text-center">
        <p class="text-xs text-gray-400 dark:text-gray-600 uppercase tracking-widest font-medium">&copy; {{ date('Y') }} Timetable Management</p>
    </footer>
</div>

</body>
</html>