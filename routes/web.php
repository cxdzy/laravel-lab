<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LecturerDashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\LecturerGroupController;
use App\Http\Controllers\StudentTimetableController;

// Show login page first
Route::get('/', fn () => view('login'));
Route::get('/login', fn () => view('login'))->name('login');

// Handle login
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    return back()->with('error', 'Invalid login')->withInput();
});

// Register routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Protected system routes
Route::middleware('auth')->group(function () {
    // Role-based dashboard redirect
    Route::get('/dashboard', function () {
        $role = auth()->user()->role ?? 'student';

        return match ($role) {
            'admin' => redirect()->route('home'),
            'lecturer' => redirect()->route('lecturer.dashboard'),
            default => redirect()->route('student.dashboard'),
        };
    })->name('dashboard');

    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/home', fn () => view('home'))->name('home');

        Route::resource('students', StudentController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('halls', HallController::class);
        Route::resource('days', DayController::class);
        Route::resource('lecturer-groups', LecturerGroupController::class);
        Route::resource('timetables', StudentTimetableController::class);
    });

    // Student-only routes
    Route::middleware('role:student')->group(function () {
        Route::get('/student', [StudentDashboardController::class, 'index'])->name('student.dashboard');
        Route::get('/student/settings', [UserSettingsController::class, 'editStudent'])->name('student.settings.edit');
        Route::put('/student/settings', [UserSettingsController::class, 'updateStudent'])->name('student.settings.update');
    });

    // Lecturer-only routes
    Route::middleware('role:lecturer')->group(function () {
        Route::get('/lecturer', [LecturerDashboardController::class, 'index'])->name('lecturer.dashboard');
        Route::get('/lecturer/settings', [UserSettingsController::class, 'editLecturer'])->name('lecturer.settings.edit');
        Route::put('/lecturer/settings', [UserSettingsController::class, 'updateLecturer'])->name('lecturer.settings.update');
    });

    // Logout
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});