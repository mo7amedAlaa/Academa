<?php

namespace App\Services\Contracts;

use Illuminate\Http\Request;


interface CheckoutContract
{
    public function checkout();
    public function success(Request $request);
    public function cancel();
}
