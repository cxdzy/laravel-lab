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
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'day_id' => 'required|exists:days,id',
            'hall_id' => 'required|exists:halls,id',
            'lecturer_group_id' => 'nullable|exists:lecturer_groups,id',
            'time_from' => 'required|date_format:H:i',
            'time_to' => 'required|date_format:H:i|after:time_from',
        ]);

        $duplicateQuery = StudentTimetable::query()
            ->where('user_id', $validated['user_id'])
            ->where('subject_id', $validated['subject_id'])
            ->where('day_id', $validated['day_id'])
            ->where('hall_id', $validated['hall_id'])
            ->where('time_from', $validated['time_from'])
            ->where('time_to', $validated['time_to']);

        if (!empty($validated['lecturer_group_id'])) {
            $duplicateQuery->where('lecturer_group_id', $validated['lecturer_group_id']);
        } else {
            $duplicateQuery->whereNull('lecturer_group_id');
        }

        if ($duplicateQuery->exists()) {
            return back()
                ->with('error', 'This timetable entry already exists.')
                ->withInput();
        }

        $conflict = StudentTimetable::query()
            ->where('hall_id', $validated['hall_id'])
            ->where('day_id', $validated['day_id'])
            ->where('time_from', '<', $validated['time_to'])
            ->where('time_to', '>', $validated['time_from'])
            ->exists();

        if ($conflict) {
            return back()
                ->with('error', 'This hall is already booked at the selected time.')
                ->withInput();
        }

        StudentTimetable::create($validated);

        return redirect()->route('timetables.index')->with('success', 'Timetable entry created.');
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
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'day_id' => 'required|exists:days,id',
            'hall_id' => 'required|exists:halls,id',
            'lecturer_group_id' => 'nullable|exists:lecturer_groups,id',
            'time_from' => 'required|date_format:H:i',
            'time_to' => 'required|date_format:H:i|after:time_from',
        ]);

        $duplicateQuery = StudentTimetable::query()
            ->whereKeyNot($timetable->id)
            ->where('user_id', $validated['user_id'])
            ->where('subject_id', $validated['subject_id'])
            ->where('day_id', $validated['day_id'])
            ->where('hall_id', $validated['hall_id'])
            ->where('time_from', $validated['time_from'])
            ->where('time_to', $validated['time_to']);

        if (!empty($validated['lecturer_group_id'])) {
            $duplicateQuery->where('lecturer_group_id', $validated['lecturer_group_id']);
        } else {
            $duplicateQuery->whereNull('lecturer_group_id');
        }

        if ($duplicateQuery->exists()) {
            return back()
                ->with('error', 'This timetable entry already exists.')
                ->withInput();
        }

        $conflict = StudentTimetable::query()
            ->whereKeyNot($timetable->id)
            ->where('hall_id', $validated['hall_id'])
            ->where('day_id', $validated['day_id'])
            ->where('time_from', '<', $validated['time_to'])
            ->where('time_to', '>', $validated['time_from'])
            ->exists();

        if ($conflict) {
            return back()
                ->with('error', 'This hall is already booked at the selected time.')
                ->withInput();
        }

        $timetable->update($validated);

        return redirect()->route('timetables.index')->with('success', 'Timetable entry updated.');
    }

    public function destroy(StudentTimetable $timetable)
    {
        $timetable->delete();

        return redirect()->route('timetables.index')
            ->with('success', 'Deleted!');
    }
}