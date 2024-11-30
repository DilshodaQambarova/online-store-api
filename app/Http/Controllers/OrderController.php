<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Auth::user()->orders;
        return OrderResource::collection($orders->load('paymentType', 'deliveryMethod', 'user'));
    }


    public function store(StoreOrderRequest $request)
    {
        $sum = 0;
        $products = Product::query()->limit(2)->get();
        $address = UserAddress::findOrFail($request->address_id);
        $order = new Order();
        $order->user_id = Auth::id();
        $order->payment_type_id = $request->payment_type_id;
        $order->delivery_method_id = $request->delivery_method_id;
        $order->comment = $request->comment;
        $order->sum = $sum;
        $order->products = $products;
        $order->address = $address;
        $order->save();

        return response()->json([
            'message' => 'Order created'
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $order;
    }


    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
