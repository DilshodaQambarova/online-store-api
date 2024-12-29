<?php

namespace App\Http\Controllers;

use App\Models\UserPaymentCard;
use App\Repositories\PaymentCardRepository;
use App\Http\Resources\UserPaymentCardResource;
use App\Http\Requests\StoreUserPaymentCardRequest;
use App\Http\Requests\UpdateUserPaymentCardRequest;

class UserPaymentCardController extends Controller
{
    protected PaymentCardRepository $cardRepository;
    public function index()
    {
        return $this->responsePagination(UserPaymentCardResource::collection(auth()->user()->paymentCards));
    }

    public function store(StoreUserPaymentCardRequest $request)
    {
        //
    }

    public function show(UserPaymentCard $userPaymentCard)
    {
        //
    }


    public function update(UpdateUserPaymentCardRequest $request, UserPaymentCard $userPaymentCard)
    {
        //
    }

    public function destroy(UserPaymentCard $userPaymentCard)
    {
        //
    }
}
