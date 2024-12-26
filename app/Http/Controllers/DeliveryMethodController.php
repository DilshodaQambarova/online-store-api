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


    public function show( $id)
    {
        $deliveryMethod = DeliveryMethod::findOrFail($id);
        return $this->success( $deliveryMethod);
    }


    public function update(UpdateDeliveryMethodRequest $request,  $id)
    {
        $deliveryMethod = DeliveryMethod::findOrFail($id);
        $deliveryMethod->name = $request->name;
        $deliveryMethod->estimated_time = $request->estimated_time;
        $deliveryMethod->price = $request->price;
        $deliveryMethod->save();
        return $this->success(new DeliveryMethodResource( $deliveryMethod), 'Delivery method updated successfully');
    }

    public function destroy( $id)
    {
        $deliveryMethod = DeliveryMethod::findOrFail($id);
        $deliveryMethod->delete();
        return $this->success([], 'Delivery method deleted successfully', 204);
    }
}
