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
    public function __construct(
        protected OrderService   $orderService,
        protected ProductService $productService,
    )
    {
        // $this->middleware('auth:sanctum');
        // $this->authorizeResource(Order::class, 'order');
    }


    public function index(): JsonResponse
    {
        if (request()->has('status_id')) {
            return $this->responsePagination(OrderResource::collection(auth()->user()->orders()->where('status_id', request('status_id'))->paginate(10)));
        }

        return $this->responsePagination(OrderResource::collection(auth()->user()->orders()->paginate(10)));
    }


    public function store(StoreOrderRequest $request): JsonResponse
    {
        // o'zgaruvchilani belgilash
        list($sum, $products, $notFoundProducts, $address, $deliveryMethod) = $this->defineVariables($request);

        // omborda product bor yo'qligiga tekshirish
        list($sum, $products, $notFoundProducts) = $this->productService->checkForStock($request['products'], $sum, $products, $notFoundProducts);

        // bor bo'lsa buyurtma yaratish
        if ($notFoundProducts === [] && $products !== [] && $sum !== 0) {
            $order = $this->orderService->saveOrder($deliveryMethod, $sum, $request, $address, $products);
            return $this->success(__('successes.order.created'));

        }
        return $this->error(__('errors.order.not_found
        '), 404);
    }

    public function show(Order $order): JsonResponse
    {
        return $this->success(new OrderResource($order));
    }


    public function destroy( $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return $this->success([], __('successes.order.deleted'), 204);
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
