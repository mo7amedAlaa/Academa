<?php

namespace App\Http\Controllers;

use App\Dto\CartDto;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use App\Http\Controllers\Controller;
use App\Services\Facades\CartFacade;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartFacade::index();

        return view('student.cart.index', compact('cartItems'));
    }

    public function addToCart(CartRequest $request)
    {
        if (CartFacade::addToCart(CartDto::formArray($request))) {
            return redirect()->back()->with('success', 'Item added to cart!');
        } else {
            return redirect()->back()->with('error', 'Item don,t added to cart!');
        }
    }
    public function remove(Request $request)
    {
        $request->validate(['id' => 'required']);
        $id = $request->id;

        if (CartFacade::remove($id)) {
            return redirect()->back()->with('success', 'Item added to cart!');
        }
        return redirect()->route('student.cart.index')->with('error', 'Item not found in cart!');
    }
}
