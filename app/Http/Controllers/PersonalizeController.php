<?php

namespace App\Http\Controllers;

use App\Dto\PersonalizeDto;
use App\Http\Requests\PersonalizeRequest;
use App\Services\Facades\CategoryFacade;
use App\Services\Facades\PersonalFacade;
use App\Services\Facades\PersonalizeFacade;
use Illuminate\Http\Request;

class PersonalizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('student.personalize');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonalizeRequest $request)
    {
        $studentId = auth()->user()->id;
        PersonalizeFacade::updatePersonalize($studentId, PersonalizeDto::fromRequest($request));
        return redirect()->route('student.dashboard')->with('message', 'Personalize saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
