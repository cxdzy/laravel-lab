<?php

namespace App\Http\Controllers;

use App\Models\StudentTimetable;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $timetables = StudentTimetable::query()
            ->with(['subject', 'day', 'hall', 'lecturerGroup'])
            ->where('user_id', auth()->id())
            ->orderBy('day_id')
            ->orderBy('time_from')
            ->get();

        return view('viewstudent.studentpage', compact('timetables'));
    }
}
