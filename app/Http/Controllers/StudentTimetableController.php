<?php

namespace App\Http\Controllers;

use App\Models\StudentTimetable;
use App\Models\User;
use App\Models\Subject;
use App\Models\Day;
use App\Models\Hall;
use App\Models\LecturerGroup;
use Illuminate\Http\Request;

class StudentTimetableController extends Controller
{
    public function index(Request $request)
    {
        $timetables = StudentTimetable::with(['user', 'subject', 'day', 'hall', 'lecturerGroup'])
            ->when($request->filled('user_name'), function ($query) use ($request) {
                $name = trim($request->input('user_name'));
                $query->whereHas('user', fn ($q) => $q->where('name', 'like', '%' . $name . '%'));
            })
            ->when($request->filled('subject_name'), function ($query) use ($request) {
                $name = trim($request->input('subject_name'));
                $query->whereHas('subject', fn ($q) => $q->where('subject_name', 'like', '%' . $name . '%'));
            })
            ->when($request->filled('day_name'), function ($query) use ($request) {
                $name = trim($request->input('day_name'));
                $query->whereHas('day', fn ($q) => $q->where('day_name', 'like', '%' . $name . '%'));
            })
            ->when($request->filled('hall_name'), function ($query) use ($request) {
                $name = trim($request->input('hall_name'));
                $query->whereHas('hall', fn ($q) => $q->where('lecture_hall_name', 'like', '%' . $name . '%'));
            })
            ->when($request->filled('group_name'), function ($query) use ($request) {
                $name = trim($request->input('group_name'));
                $query->whereHas('lecturerGroup', fn ($q) => $q->where('name', 'like', '%' . $name . '%'));
            })
            ->get();

        return view('timetables.index', compact('timetables'));
    }

    public function create()
    {
        return view('timetables.create', [
            'users' => User::all(),
            'subjects' => Subject::all(),
            'days' => Day::all(),
            'halls' => Hall::all(),
            'groups' => LecturerGroup::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'subject_id' => 'required',
            'day_id' => 'required',
            'hall_id' => 'required',
            'lecturer_group_id' => 'required',
        ]);

        StudentTimetable::create($request->all());

        return redirect()->route('timetables.index')
            ->with('success', 'Timetable created!');
    }

    public function show(StudentTimetable $timetable)
    {
        $timetable->load(['user', 'subject', 'day', 'hall', 'lecturerGroup']);

        return view('timetables.show', compact('timetable'));
    }

    public function edit(StudentTimetable $timetable)
    {
        return view('timetables.edit', [
            'timetable' => $timetable,
            'users' => User::all(),
            'subjects' => Subject::all(),
            'days' => Day::all(),
            'halls' => Hall::all(),
            'groups' => LecturerGroup::all(),
        ]);
    }

    public function update(Request $request, StudentTimetable $timetable)
    {
        $timetable->update($request->all());

        return redirect()->route('timetables.index')
            ->with('success', 'Updated!');
    }

    public function destroy(StudentTimetable $timetable)
    {
        $timetable->delete();

        return redirect()->route('timetables.index')
            ->with('success', 'Deleted!');
    }
}