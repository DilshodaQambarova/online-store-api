<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index($id)
{
    $category = Category::with('products.stocks')
        ->where('id', $id)
        ->firstOrFail();

    $products = $category->products()->paginate(10);

    return response()->json([
        'category' => new CategoryResource($category->load('productsd')),
        'links' => [
            'first' => $products->url(1),
            'last' => $products->url($products->lastPage()),
            'prev' => $products->previousPageUrl(),
            'next' => $products->nextPageUrl(),
        ],
        'meta' => [
            'current_page' => $products->currentPage(),
            'from' => $products->firstItem(),
            'last_page' => $products->lastPage(),
            'path' => $products->path(),
            'per_page' => $products->perPage(),
            'to' => $products->lastItem(),
            'total' => $products->total(),
        ],
    ]);
}

}
