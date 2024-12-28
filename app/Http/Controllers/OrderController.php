<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Models\UserAddress;
use App\Repositories\OrderRepository;
use App\Repositories\StockRepository;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {


        return $this->responsePagination(OrderResource::collection(auth()->user()->orders()->paginate(10)));
    }


    public function store(StoreOrderRequest $request)
    {

    }


    public function show(Order $order): JsonResponse
    {
        return $this->success(new OrderResource($order));
    }


    public function destroy( $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return $this->success([], 'Order deleted succesfully', 204);
    }


    public function defineVariables(StoreOrderRequest $request): array
    {
        $sum = 0;
        $products = [];
        $notFoundProducts = [];
        $address = UserAddress::find($request->address_id);
        $deliveryMethod = DeliveryMethod::findOrFail($request->delivery_method_id);
        return array($sum, $products, $notFoundProducts, $address, $deliveryMethod);
    }
}
