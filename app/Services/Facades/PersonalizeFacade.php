<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class PersonalizeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'personalizeService';
    }
}
