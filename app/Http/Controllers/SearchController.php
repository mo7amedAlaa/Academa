<?php

// app/Http/Controllers/SearchController.php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\Facades\SearchFacade;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $searchResults = SearchFacade::search($request);
        return view('welcome', ['searchResult' => $searchResults]);
    }
}
