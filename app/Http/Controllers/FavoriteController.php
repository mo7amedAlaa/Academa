<?php

namespace App\Http\Controllers;

use App\Dto\FavoriteDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\FavoriteRequest;
use App\Services\Facades\FavoriteFacade;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display the list of favorite courses for the authenticated student.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Ensure the user has a student record
        if (!$user || !$user->student) {
            return redirect()->back()->with('error', 'Student record not found.');
        }

        // Get the student's favorites
        $favorites = FavoriteFacade::getFavorites($user->student->id);

        // Return the view with the favorites
        return view('student.favorites.index', compact('favorites'));
    }

    /**
     * Add a course to the student's favorites.
     *
     * @param FavoriteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(FavoriteRequest $request)
    {

        $dto = FavoriteDto::fromArray($request);


        if (FavoriteFacade::addFavorite($dto)) {
            return redirect()->back()->with('success', 'Course added to favorites!');
        }

        return redirect()->back()->with('error', 'Failed to add course to favorites.');
    }

    /**
     * Remove a course from the student's favorites.
     *
     * @param FavoriteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(FavoriteRequest $request)
    {
        // Convert request data to DTO
        $dto = FavoriteDto::fromArray($request);

        // Use the facade to remove a favorite
        if (FavoriteFacade::removeFavorite($dto)) {
            return redirect()->back()->with('success', 'Course removed from favorites!');
        }

        return redirect()->back()->with('error', 'Failed to remove course from favorites.');
    }
}
