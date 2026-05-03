<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Minimalist Management</title>
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
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Theme Toggle -->
        <div class="flex justify-end mb-6">
            <button onclick="toggleTheme()" class="p-2 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white transition-colors focus:outline-none">
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z"></path></svg>
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
        </div>

        <!-- Login Card -->
        <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl shadow-sm p-8 lg:p-12">
            <header class="text-center mb-10">
                <h1 class="text-3xl font-light tracking-tight text-gray-900 dark:text-white mb-2">Welcome Back</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Sign in to access your dashboard</p>
            </header>

            <!-- Error Handling -->
            @if(session('error'))
                <div class="mb-8 p-4 bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-800/30 rounded-xl">
                    <div class="flex items-center text-sm text-red-700 dark:text-red-400">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Email Address</label>
                    <input type="email" name="email" id="email" required placeholder="name@example.com"
                           class="input-focus w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-xl text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-600">
                </div>

                <!-- Password -->
                <div>
                    <div class="flex justify-between items-center mb-3">
                        <label for="password" class="block text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Password</label>
                        <a href="/forgot-password" class="text-[10px] text-gray-400 hover:text-black dark:hover:text-white transition-colors uppercase tracking-widest font-bold">Forgot?</a>
                    </div>
                    <input type="password" name="password" id="password" required placeholder="••••••••"
                           class="input-focus w-full px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 rounded-xl text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-600">
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="btn-transition w-full bg-black hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 dark:text-black text-white py-4 rounded-xl font-medium text-sm shadow-lg shadow-black/5 dark:shadow-none">
                        Sign In
                    </button>
                </div>
            </form>

            <footer class="mt-10 text-center">
                <p class="text-xs text-gray-400 dark:text-gray-600 uppercase tracking-widest font-medium">
                    New here? <a href="/register" class="text-black dark:text-white font-bold ml-1 hover:underline">Create Account</a>
                </p>
            </footer>
        </div>
        
        <p class="mt-8 text-center text-[10px] text-gray-400 dark:text-gray-600 uppercase tracking-widest font-bold">
            &copy; {{ date('Y') }} Management System
        </p>
    </div>

</body>
</html>