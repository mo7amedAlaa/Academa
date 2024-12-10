<?php

namespace App\Services\Services;

use App\Repositories\CheckoutRepository;
use App\Services\Contracts\CheckoutContract;
use Illuminate\Http\Request;

class CheckoutService implements CheckoutContract
{

    protected CheckoutRepository $checkoutRepository;

    public function __construct()
    {
        $this->checkoutRepository =   new CheckoutRepository();
    }
    public function checkout()
    {
        return $this->checkoutRepository->checkout();
    }
    public function success(Request $request)
    {
        return $this->checkoutRepository->success($request);
    }
    public function cancel()
    {
        return $this->checkoutRepository->cancel();
    }
}
