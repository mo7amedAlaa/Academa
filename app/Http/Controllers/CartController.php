<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $cartItems = session()->get("cart.$userId", []);

        return view('student.cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $userId = auth()->id();
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'cover_image' => 'nullable',
        ]);


        $cart = session()->get("cart.$userId", []);

        if (!isset($cart[$request->id])) {
            $cart[$request->id] = [
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'cover_image' => $request->cover_image
            ];
        }

        session()->put("cart.$userId", $cart);

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function update(Request $request)
    {
        $userId = auth()->id();

        $request->validate(['id' => 'required']);

        $cart = session()->get("cart.$userId", []);

        if (isset($cart[$request->id])) {
            session()->put("cart.$userId", $cart);
            return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
        }

        return redirect()->route('student.cart.index')->with('error', 'Item not found in cart!');
    }

    public function remove(Request $request)
    {
        $userId = auth()->id();

        $request->validate(['id' => 'required']);

        $cart = session()->get("cart.$userId", []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put("cart.$userId", $cart);
            return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
        }

        return redirect()->route('student.cart.index')->with('error', 'Item not found in cart!');
    }
}
