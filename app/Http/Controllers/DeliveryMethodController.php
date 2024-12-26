<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeliveryMethodResource;
use App\Models\DeliveryMethod;
use App\Http\Requests\StoreDeliveryMethodRequest;
use App\Http\Requests\UpdateDeliveryMethodRequest;

class DeliveryMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryMethods = DeliveryMethod::paginate(5);
        return $this->responsePagination($deliveryMethods, DeliveryMethodResource::collection($deliveryMethods));
    }

    public function store(StoreDeliveryMethodRequest $request)
    {
        $deliveryMethod = new DeliveryMethod();
        $deliveryMethod->name = $request->name;
        $deliveryMethod->estimated_time = $request->estimated_time;
        $deliveryMethod->price = $request->price;
        $deliveryMethod->save();
        return $this->success(new DeliveryMethodResource( $deliveryMethod), 'Delivery method created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryMethod $deliveryMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliveryMethod $deliveryMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryMethodRequest $request, DeliveryMethod $deliveryMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryMethod $deliveryMethod)
    {
        //
    }
}
