<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // Display a list of all students
    public function index()
    {
        $students = User::all();
        return view('students.index', compact('students'));
    }

    // Show form to create a new student
    public function create()
    {
        return view('students.create');
    }

    // Store a newly created student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable',
            'address' => 'nullable',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => Hash::make($request->password), // ✅ better
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully!');
    }

    // Show student details
    public function show(User $student)
    {
        return view('students.show', compact('student'));
    }

    // Show edit form
    public function edit(User $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'phone_number' => 'nullable',
            'address' => 'nullable',
        ]);

        // ✅ safer update (DON’T use $request->all())
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    // Delete student
    public function destroy(User $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}