<?php

// app/Http/Controllers/SearchController.php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\Facades\CourseFacade;
use App\Services\Facades\SearchFacade;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $topRatedCourses = CourseFacade::getTopRatedCourses(5);
        $recentlyAddedCourses = CourseFacade::getRecentlyAddedCourses(5);
        $popularCourses = CourseFacade::getPopularCourses(5);
        $searchResults = SearchFacade::search($request);
        return view('welcome', ['searchResult' => $searchResults]);
    }
}
