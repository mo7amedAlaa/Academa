<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('student.settings', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
            'current_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided current password is incorrect.']);
        }

        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('settings')->with('status', 'Account updated successfully.');
    }

    public function delete(Request $request)
    {
        $user = Auth::user();

        $user->delete();

        Auth::logout();

        return redirect('/')->with('status', 'Your account has been deleted.');
    }
}
