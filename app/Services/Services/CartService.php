<?php

namespace App\Services\Services;

use App\Dto\CartDto;
use App\Repositories\CartRepository;
use App\Services\Contracts\CartContract;

class CartService implements CartContract
{

    protected CartRepository $cartRepository;

    public function __construct()
    {
        $this->cartRepository = new CartRepository();
    }
    public function index()
    {
        return $this->cartRepository->index();
    }
    public function addToCart(CartDto $request)
    {
        return $this->cartRepository->addToCart($request);
    }
    public function remove($id)
    {
        return $this->cartRepository->remove($id);
    }
}
