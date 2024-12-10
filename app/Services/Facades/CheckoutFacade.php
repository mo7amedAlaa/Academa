<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class CheckoutFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'checkoutService';
    }
}
