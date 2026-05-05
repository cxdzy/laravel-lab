<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public function index()
    {
        $days = Day::all();
        return view('days.index', compact('days'));
    }

    public function create()
    {
        return view('days.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'day_name' => 'required|string|max:50',
        ]);

        Day::create($validated);

        return redirect()->route('days.index')
            ->with('success', 'Day created successfully!');
    }

    public function show(Day $day)
    {
        return view('days.show', compact('day'));
    }

    public function edit(Day $day)
    {
        return view('days.edit', compact('day'));
    }

    public function update(Request $request, Day $day)
    {
        $validated = $request->validate([
            'day_name' => 'required|string|max:50',
        ]);

        $day->update($validated);

        return redirect()->route('days.index')
            ->with('success', 'Day updated successfully!');
    }

    public function destroy(Day $day)
    {
        $day->delete();

        return redirect()->route('days.index')
            ->with('success', 'Day deleted successfully!');
    }
}