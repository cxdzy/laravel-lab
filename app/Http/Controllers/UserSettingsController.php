<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserSettingsController extends Controller
{
    public function editStudent()
    {
        return view('viewstudent.studentsettings');
    }

    public function updateStudent(Request $request)
    {
        $user = $request->user();

        abort_if(($user->role ?? 'student') !== 'student', 403);

        $validated = $this->validatedProfileData($request, $user->id);

        $user->update($this->profileUpdatePayload($validated));

        return back()->with('success', 'Profile updated successfully.');
    }

    public function editLecturer()
    {
        return view('viewlecturer.lecturersettings');
    }

    public function updateLecturer(Request $request)
    {
        $user = $request->user();

        abort_if(($user->role ?? 'student') !== 'lecturer', 403);

        $validated = $this->validatedProfileData($request, $user->id);

        $user->update($this->profileUpdatePayload($validated));

        return back()->with('success', 'Profile updated successfully.');
    }

    private function validatedProfileData(Request $request, int $userId): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $userId],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => [
                'nullable',
                'string',
                'confirmed',
                'min:8',
                'regex:/[0-9]/',
                'regex:/[^A-Za-z0-9]/',
            ],
        ]);
    }

    private function profileUpdatePayload(array $validated): array
    {
        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'] ?? null,
            'address' => $validated['address'] ?? null,
        ];

        if (!empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        return $payload;
    }
}
