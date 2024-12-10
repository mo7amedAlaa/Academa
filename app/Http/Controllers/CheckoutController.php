<?php

namespace App\Http\Controllers;

use App\Services\Facades\CheckoutFacade;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {


        return CheckoutFacade::checkout();
    }


    public function success(Request $request)
    {

        $success = CheckoutFacade::success($request);
        if ($success) {

            return view('student.checkout.success');
        } else {
            return redirect()->route('home')->with('error', 'Payment Failed!');
        }
    }


    public function cancel()
    {
        return view('student.checkout.cancel');
    }
}
