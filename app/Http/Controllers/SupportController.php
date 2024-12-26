<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SupportRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class SupportController extends Controller
{
    // Show the contact support page
    public function index()
    {
        return view('contact-support');
    }

    // Handle form submission
    public function submit(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $supportTeam = User::role('admin')->first();
        $supportTeam->notify(
            new SupportRequestNotification($request->all())
        );

        return redirect()->route('support.contact')->with('success', 'Your message has been sent successfully!');
    }
}
