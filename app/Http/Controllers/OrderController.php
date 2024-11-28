<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::all();
    }


    public function store(StoreOrderRequest $request)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->payment_type_id = $request->payment_type_id;
        $order->delivery_method_id = $request->delivery_method_id;
        $order->comment = $request->comment;
        $order->sum = $request->sum;
        $order->products = json_encode($request->products);
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
        //
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
