<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Http\Resources\PaymentTypeResource;
use App\Http\Requests\StorePaymentTypeRequest;
use App\Http\Requests\UpdatePaymentTypeRequest;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentTypes = PaymentType::all();
        return $this->success(PaymentTypeResource::collection($paymentTypes));
    }

    public function store(StorePaymentTypeRequest $request)
    {
        $paymentType = new PaymentType();
        $paymentType->name = $request->name;
        $paymentType->save();
        return $this->success(new PaymentTypeResource($paymentType), 'Payment type created successfully', 201);
    }

    public function show(PaymentType $paymentType)
    {
        //
    }

    public function update(UpdatePaymentTypeRequest $request, $id)
    {
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentType $paymentType)
    {
        //
    }
}
