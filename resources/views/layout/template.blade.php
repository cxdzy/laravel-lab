<!doctype html>
<html lang="en" data-bs-theme="light" data-lte-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') | My System</title>

    <script>
        // Apply saved theme as early as possible (before CSS)
        (() => {
            try {
                const saved = localStorage.getItem('theme');
                const systemPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                const theme = saved ? (saved === 'dark' ? 'dark' : 'light') : (systemPrefersDark ? 'dark' : 'light');
                document.documentElement.setAttribute('data-bs-theme', theme);
                document.documentElement.setAttribute('data-lte-theme', theme);
            } catch (e) {
                // Ignore storage access errors
            }
        })();
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5.0.0/index.css">
    
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --adminlte-body-font-family: 'Inter', sans-serif;
        }

        /* Minimalist tweaks */
        .app-header { border-bottom: 1px solid var(--bs-border-color); }
        .app-sidebar { border-right: 1px solid var(--bs-border-color); }
        
        /* Smooth Sidebar Transitions */
        .nav-link { 
            border-radius: 8px; 
            margin: 2px 10px; 
            transition: all 0.2s ease;
        }
        
        /* Card Styling to be used in children */
        .card { 
            border: none; 
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); 
            border-radius: 12px;
        }

        /* Dark mode button styling */
        .theme-switch { cursor: pointer; }
    </style>
    
    @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    <nav class="app-header navbar navbar-expand bg-body shadow-sm">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item px-2">
                    <button class="nav-link theme-switch" id="theme-toggle" type="button" aria-label="Toggle theme">
                        <i class="bi bi-moon-stars" id="theme-icon"></i>
                    </button>
                </li>

                <li class="nav-item">
                    <form action="/logout" method="POST" class="m-0">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm border-0 fw-bold">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <aside class="app-sidebar bg-body shadow-sm">
        <div class="sidebar-brand">
            <a href="{{ url('/dashboard') }}" class="brand-link">
                <span class="brand-text fw-bold text-primary">MY<span class="text-body-emphasis">SYSTEM</span></span>
            </a>
        </div>

        <div class="sidebar-wrapper">
            <nav class="mt-3">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">

                    <li class="nav-item">
                        <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header text-uppercase small opacity-50 px-3 mt-2">Management</li>

                    <li class="nav-item">
                        <a href="{{ route('students.index') }}" class="nav-link {{ request()->is('students*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people"></i>
                            <p>Students</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('subjects.index') }}" class="nav-link {{ request()->is('subjects*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-book"></i>
                            <p>Subjects</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('halls.index') }}" class="nav-link {{ request()->is('halls*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-building"></i>
                            <p>Halls</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('days.index') }}" class="nav-link {{ request()->is('days*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-calendar3"></i>
                            <p>Days</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('lecturer-groups.index') }}" class="nav-link {{ request()->is('lecturer-groups*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-badge"></i>
                            <p>Lecturer Groups</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('timetables.index') }}" class="nav-link {{ request()->is('timetables*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-grid-3x3"></i>
                            <p>Timetables</p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    <main class="app-main">
        <div class="app-content-header py-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">@yield('page_title')</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </main>

    <footer class="app-footer text-center small text-muted py-3">
        <strong>&copy; {{ date('Y') }}</strong> Minimalist Admin.
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>

<script>
    (() => {
        // THEME TOGGLE LOGIC
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const htmlElement = document.documentElement;

        function normalizeTheme(value) {
            return value === 'dark' ? 'dark' : 'light';
        }

        function getSavedTheme() {
            try {
                const saved = localStorage.getItem('theme');
                if (saved) return normalizeTheme(saved);
                const systemPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                return systemPrefersDark ? 'dark' : 'light';
            } catch (e) {
                const systemPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                return systemPrefersDark ? 'dark' : 'light';
            }
        }

        function applyTheme(theme) {
            const next = normalizeTheme(theme);

            // Bootstrap 5.3 color modes
            htmlElement.setAttribute('data-bs-theme', next);

            // AdminLTE may also read its own attribute
            htmlElement.setAttribute('data-lte-theme', next);

            try {
                localStorage.setItem('theme', next);
            } catch (e) {
                // Ignore storage write errors
            }

            if (themeIcon) {
                if (next === 'dark') {
                    themeIcon.classList.remove('bi-moon-stars');
                    themeIcon.classList.add('bi-sun');
                } else {
                    themeIcon.classList.remove('bi-sun');
                    themeIcon.classList.add('bi-moon-stars');
                }
            }

            if (themeToggle) {
                themeToggle.setAttribute('aria-label', next === 'dark' ? 'Switch to light mode' : 'Switch to dark mode');
            }
        }

        // Ensure icon matches persisted theme
        applyTheme(getSavedTheme());

        if (themeToggle) {
            themeToggle.addEventListener('click', (e) => {
                e.preventDefault();
                const current = normalizeTheme(htmlElement.getAttribute('data-bs-theme'));
                applyTheme(current === 'dark' ? 'light' : 'dark');
            });
        }
    })();
</script>

@stack('scripts')

</body>
</html>