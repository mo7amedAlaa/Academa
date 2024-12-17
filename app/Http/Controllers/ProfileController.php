<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        $student = $user->student;
        $instructor = $user->instructor;
        $category = $student?->interests_field ? Category::find($student->interests_field) : null;

        return view('auth.profile.show', compact('user', 'student', 'instructor', 'category'));
    }

    public function edit()
    {
        $user = Auth::user();
        $student = $user->student;
        $instructor = $user->instructor;

        return view('auth.profile.edit', compact('user', 'student', 'instructor'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'nullable|string|max:500',
            'age' => 'nullable|integer|min:6|max:120',
            'nationality' => 'nullable|string|max:255',
            'interests_field' => 'nullable',
            'experience_years' => 'nullable|integer|min:0',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'avatar' => $this->handleAvatarUpload($user, $request->file('avatar')),
        ]);

        if ($user->student) {
            $user->student->update([
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'interests_field' => $validated['interests_field'],
            ]);
        }

        if ($user->instructor) {
            $user->instructor->update([
                'phone' => $validated['phone'],
                'bio' => $validated['bio'],
                'age' => $validated['age'],
                'nationality' => $validated['nationality'],
                'experience_years' => $validated['experience_years'],
            ]);
        }

        return redirect()->route('profile.show')
            ->with('status', 'Profile updated successfully.');
    }

    private function handleAvatarUpload($user, $avatarFile)
    {
        if ($avatarFile) {
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }

            $avatarName = uniqid('avatar_') . '.' . $avatarFile->getClientOriginalExtension();
            $avatarFile->move(public_path('uploads/avatars/'), $avatarName);

            return "uploads/avatars/" . $avatarName;
        }

        return $user->avatar;
    }
}
