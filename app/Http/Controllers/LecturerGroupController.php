<?php

namespace App\Http\Controllers;

use App\Models\LecturerGroup;
use Illuminate\Http\Request;

class LecturerGroupController extends Controller
{
    public function index()
    {
        $groups = LecturerGroup::all();
        return view('lecturer_groups.index', compact('groups'));
    }

    public function create()
    {
        return view('lecturer_groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'part' => 'required',
        ]);

        LecturerGroup::create($request->all());

        return redirect()->route('lecturer-groups.index')
            ->with('success', 'Group created successfully!');
    }

    public function show(LecturerGroup $lecturer_group)
    {
        return view('lecturer_groups.show', compact('lecturer_group'));
    }

    public function edit(LecturerGroup $lecturer_group)
    {
        return view('lecturer_groups.edit', compact('lecturer_group'));
    }

    public function update(Request $request, LecturerGroup $lecturer_group)
    {
        $request->validate([
            'name' => 'required',
            'part' => 'required',
        ]);

        $lecturer_group->update($request->all());

        return redirect()->route('lecturer-groups.index')
            ->with('success', 'Group updated successfully!');
    }

    public function destroy(LecturerGroup $lecturer_group)
    {
        $lecturer_group->delete();

        return redirect()->route('lecturer-groups.index')
            ->with('success', 'Group deleted successfully!');
    }
}