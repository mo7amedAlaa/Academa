<?php

namespace App\Services\Contracts;

use App\Dto\CartDto;



interface CartContract
{

    public function index();
    public function addToCart(CartDto $request);
    public function remove(CartDto $request);
}
