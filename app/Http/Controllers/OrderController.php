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

        return $this->success(new OrderResource($order), 'Order created', 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return new OrderResource($order->load('user', 'deliveryMethod', 'paymentType'));
    }


    public function update(UpdateOrderRequest $request, $id)
    {
        $sum = 0;
        $products = Product::query()->limit(2)->get();
        $address = UserAddress::findOrFail($request->address_id);

        $order = Order::find($id);
        if(!$order){
            return $this->error('Order not found', 404);
        }
        $order->payment_type_id = $request->payment_type_id;
        $order->delivery_method_id = $request->delivery_method_id;
        $order->comment = $request->comment;
        $order->sum = $sum;
        $order->products = $products;
        $order->address = $address;
        $order->save();

        return $this->success(new OrderResource($order), 'Order updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }
}
