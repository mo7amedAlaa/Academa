<?php

namespace App\Services\Contracts;

use App\Http\Requests\SearchRequest;

interface SearchContract
{
    public function search(SearchRequest $request);
}
