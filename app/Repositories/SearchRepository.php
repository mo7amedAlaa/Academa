<?php

namespace App\Repositories;

use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;

class SearchRepository
{
    public function search(SearchRequest $request)
    {

        $query = $request->input('query', '');


        if (empty($query)) {
            return [
                'categories' => collect(),
                'courses' => collect(),
                'instructors' => collect(),
                'query' => $query
            ];
        }

        $categories = Category::where('name', 'LIKE', "%{$query}%")->get();
        $courses = Course::where('title', 'LIKE', "%{$query}%")->get();
        $instructors =   $instructors = Instructor::whereHas('user', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })->get();

        return compact('categories', 'courses', 'instructors', 'query');
    }
}
