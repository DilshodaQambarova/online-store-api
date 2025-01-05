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
        return $this->success(new PaymentTypeResource($paymentType), __('successes.paymentType.created'), 201);
    }

    public function show($id)
    {
        $paymentType = PaymentType::findOrFail($id);
        return $this->success(new PaymentTypeResource($paymentType));
    }

    public function update(UpdatePaymentTypeRequest $request, $id)
    {
        $paymentType = PaymentType::findOrFail($id);
        $paymentType->name = $request->name;
        $paymentType->save();

        return $this->success(new PaymentTypeResource($paymentType), __('successes.paymentType.updated'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paymentType = PaymentType::findOrFail($id);
        $paymentType->delete();
        return $this->success([], __('successes.paymentType.deleted'), 204);
    }
}
