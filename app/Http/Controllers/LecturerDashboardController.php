<?php

namespace App\Http\Controllers;

use App\Models\StudentTimetable;

class LecturerDashboardController extends Controller
{
    public function index()
    {
        $lecturerName = auth()->user()->name;

        $classes = StudentTimetable::query()
            ->selectRaw('MIN(id) as id, subject_id, day_id, hall_id, lecturer_group_id, time_from, time_to')
            ->whereHas('subject', function ($query) use ($lecturerName) {
                $query->where('lecturer_name', $lecturerName);
            })
            ->groupBy('subject_id', 'day_id', 'hall_id', 'lecturer_group_id', 'time_from', 'time_to')
            ->with(['subject', 'day', 'hall', 'lecturerGroup'])
            ->orderBy('day_id')
            ->orderBy('time_from')
            ->get();

        return view('viewlecturer.lecturerpage', compact('classes'));
    }
}
