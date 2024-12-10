<?php

namespace App\Services\Facades;


use Illuminate\Support\Facades\Facade;
use App\Services\Contracts\FavoriteServiceContract;

class FavoriteFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'favoritesService';
    }
}
