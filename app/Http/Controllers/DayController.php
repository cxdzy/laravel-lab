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
        $request->validate([
            'day_name' => 'required',
        ]);

        Day::create($request->all());

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
        $request->validate([
            'day_name' => 'required',
        ]);

        $day->update($request->all());

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