<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stock;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
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
        $summ = 0;
        $products = [];
        $address = UserAddress::findOrFail($request->address_id);
        foreach ($request['products'] as $product) {
            $prod = Product::with('stocks')->findOrFail($product['product_id']);
            $stock = Stock::find($product['stock_id']);
            $prod->quantity = $product->quantity;
            if ($stock && $stock->quantity >= $product['quantity']) {

                $productWithStock = $prod->withStock($product['stock_id']);
                $productResource = new ProductResource($productWithStock);
                $summ += $productResource['price'];
                $products[] = $productResource->resolve();
            }
        }
        // TODO add status of order
        $order = new Order();
        $order->user_id = Auth::id();
        $order->payment_type_id = $request->payment_type_id;
        $order->delivery_method_id = $request->delivery_method_id;
        $order->comment = $request->comment;
        $order->summ = $summ;
        $order->products = $products;
        $order->address = $address;
        $order->save();

        return $this->success(new OrderResource($order), 'Order created', 201);

    }

    public function show($id)
    {
        $order = Auth::user()->orders()->find($id);
        if(!$order){
            return $this->error('Order not found', 404);
        }
        return $this->success(new OrderResource($order->load('user', 'deliveryMethod', 'paymentType')));
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $products = Product::query()->limit(2)->get();
        $address = UserAddress::findOrFail($request->address_id);

        $order = Order::find($id);
        if (!$order) {
            return $this->error('Order not found', 404);
        }
        $order->payment_type_id = $request->payment_type_id;
        $order->delivery_method_id = $request->delivery_method_id;
        $order->comment = $request->comment;
        $order->summ = $request->summ;
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
