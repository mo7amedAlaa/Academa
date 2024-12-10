<?php

namespace App\Http\Controllers;

use App\Dto\AuthDto;
use App\Http\Requests\InstructorRegRequest;
use App\Models\Instructor;
use App\Services\Facades\AuthFacade;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    public function create()
    {
        return view('instructor.register');
    }




    public function store(InstructorRegRequest $request)
    {


        $user = AuthFacade::instructorRegister(AuthDto::instructorsStore($request));

        $instructor = Instructor::where('user_id', $user->id)->first();

        if (!$instructor) {
            abort(500, 'Instructor registration failed.');
        }

        return redirect()->route('instructors.dashboard');
    }
}
