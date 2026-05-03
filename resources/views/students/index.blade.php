<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students | Minimalist Management</title>
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

<div class="max-w-6xl mx-auto px-4 py-12">
    <!-- Header -->
    <header class="flex justify-between items-end mb-10">
        <div>
            <h1 class="text-3xl font-light tracking-tight text-gray-900 dark:text-white">Students</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage academic records and student profiles</p>
        </div>
        <div class="flex items-center space-x-4">
            <!-- Theme Toggle Button -->
            <button onclick="toggleTheme()" class="p-2 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition-colors focus:outline-none">
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z"></path></svg>
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
            <a href="{{ route('students.create') }}" 
               class="btn-transition bg-black hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 dark:text-black text-white px-6 py-2.5 rounded-full text-sm font-medium shadow-sm">
                + Add New Student
            </a>
        </div>
    </header>

    <!-- Feedback Message -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800/30 text-green-700 dark:text-green-400 text-sm rounded-xl flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Content Card -->
    <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider w-16">ID</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Contact Info</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach($students as $student)
                    <tr class="group hover:bg-gray-50/30 dark:hover:bg-gray-800/30 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-400 dark:text-gray-600 font-mono">
                            {{ str_pad($student->id, 3, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $student->name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $student->email }}</span>
                                <span class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{ $student->phone_number ?? 'No phone provided' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-500 dark:text-gray-400 line-clamp-1 max-w-[200px]" title="{{ $student->address }}">
                                {{ $student->address ?? '—' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-center space-x-1">
                                <a href="{{ route('students.show', $student->id) }}" 
                                   class="btn-transition text-gray-400 dark:text-gray-500 hover:text-black dark:hover:text-white p-2 rounded-lg hover:bg-white dark:hover:bg-gray-800 hover:shadow-sm"
                                   title="View Profile">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </a>
                                
                                <a href="{{ route('students.edit', $student->id) }}" 
                                   class="btn-transition text-gray-400 dark:text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 p-2 rounded-lg hover:bg-white dark:hover:bg-gray-800 hover:shadow-sm"
                                   title="Edit Details">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>

                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn-transition text-gray-300 dark:text-gray-700 hover:text-red-500 dark:hover:text-red-400 p-2 rounded-lg hover:bg-white dark:hover:bg-gray-800 hover:shadow-sm"
                                            onclick="return confirm('Delete this student record?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($students->isEmpty())
        <div class="px-6 py-20 text-center bg-white dark:bg-gray-900">
            <svg class="w-12 h-12 text-gray-200 dark:text-gray-800 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <p class="text-gray-400 dark:text-gray-600 text-sm italic">No student records found in the database.</p>
            <a href="{{ route('students.create') }}" class="mt-4 inline-block text-black dark:text-white text-sm font-medium underline">Register your first student</a>
        </div>
        @endif
    </div>

    <footer class="mt-12 text-center">
        <p class="text-xs text-gray-400 dark:text-gray-600 uppercase tracking-widest font-medium">&copy; {{ date('Y') }} Student Information System</p>
    </footer>
</div>

</body>
</html>