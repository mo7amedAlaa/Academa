<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class CourseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'courseService';
    }
}
