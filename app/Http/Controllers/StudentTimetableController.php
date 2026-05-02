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
    public function index()
    {
        $timetables = StudentTimetable::with(['user','subject','day','hall','lecturerGroup'])->get();
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