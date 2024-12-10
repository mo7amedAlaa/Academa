<?php


namespace App\Services\Services;

use App\Http\Requests\SearchRequest;
use App\Repositories\SearchRepository;
use App\Services\Contracts\SearchContract;

class SearchService implements SearchContract
{
    protected SearchRepository $searchRepository;

    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    public function search(SearchRequest $request)
    {
        return $this->searchRepository->search($request);
    }
}
