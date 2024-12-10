<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    //
    public function verify(Request $request)
    {
        $user = Auth::user();

        // Check if the user is already verified
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('profile.show')->with('status', 'Your email is already verified.');
        }

        // Verify the email
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('profile.show')->with('status', 'Your email has been successfully verified.');
    }
    public function  notice()
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }


        if (!Auth::user()->hasVerifiedEmail()) {
            return view('auth.verify');
        }


        return redirect()->route('profile.show')->with('status', 'Your email is already verified.');
    }
    public function resend()
    {
        $user = Auth::user();
        if ($user->hasVerifiedEmail()) {
            return redirect()->back()->with('status', 'Your email is already verified.');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'A new verification link has been sent to your email address.');
    }
}
