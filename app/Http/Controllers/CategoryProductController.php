<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoryProductController extends Controller
{
    public function index($id)
    {
        $category = Category::with('products.stocks')
            ->where('id', $id)
            ->first();

        $products = $category->products()->paginate(10);
        if (!$category || !$products) {
            return $this->error('Not found', 404);
        }
        return $this->responsePagination($products, new CategoryResource($category->load('products')));
    }
    
}
