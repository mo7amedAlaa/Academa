<?php

namespace App\Repositories;

use App\Dto\CartDto;

class CartRepository
{
    public function index()
    {
        $userId = auth()->id();
        $cartItems = session()->get("cart.$userId", []);
        return $cartItems;
    }

    public function addToCart(CartDto $request)
    {
        $userId = auth()->id();
        $cart = session()->get("cart.$userId", []);


        if (!isset($cart[$request->id])) {
            $cart[$request->id] = [
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'cover_image' => $request->cover_image
            ];
            session()->put("cart.$userId", $cart);
            return true;
        }
        if (isset($cart[$request->id])) {
            return true;
        }

        if (session()->put("cart.$userId", $cart)) {
            return true;
        }
        return false;
    }



    public function remove($id)
    {
        $userId = auth()->id();



        $cart = session()->get("cart.$userId", []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put("cart.$userId", $cart);
            return true;
        }

        return false;
    }
}
