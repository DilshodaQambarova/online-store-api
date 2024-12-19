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
    public function store(Request $request){
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return $this->success($category, 'Category created successfully', 201);
    }
    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return $this->success($category, 'Category update successfully');
    }
    public function show($id){
        $category = Category::with('products.stocks')->findOrFail($id);
        return $this->success($category);

    }
    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->success([], 'Category deleted successfully', 204);
    }
}
