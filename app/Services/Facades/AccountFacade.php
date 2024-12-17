<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class AccountFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'accountService';
    }
}
