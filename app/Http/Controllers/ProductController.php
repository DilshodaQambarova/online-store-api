<?php

namespace App\Http\Controllers;

use Request;
use ProductFilter;
use App\Models\Product;
use App\Models\Category;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\FilterProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('stocks')->paginate(25);
        return $this->responsePagination($products, ProductResource::collection($products));
    }

    public function store(StoreProductRequest $request)
    {
        $category = Category::find($request->category_id);
        if(!$category){
            return $this->error('Category not found', 404);
        }
        $product = $category->products()->create([
            'category_id' => $category->id,
            'name' => $request->name,
            'description' => $request->description
        ]);
        $product->status->name = $request->status;
        $product->status()->save();
        return $this->success($product, 'Product Created', 201);
    }

    public function show($id)
    {
        $product = Product::with('stocks', 'category')->find($id);
        if(!$product){
            return $this->error('Product not found', 404);
        }
        return $this->success(new ProductResource($product));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        if(!$product){
            return $this->error('Product not found', 404);
        }
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        $product->status->name = $request->status;
        $product->status()->save();
        return $this->success($product, 'Product updated');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if(!$product){
            return $this->error('Product not found', 404);
        }
        $product->delete();
        return $this->success([], 'Product deleted', 204);
    }
    public function productFilter(FilterProductRequest $request){
        $filter = new ProductFilter();
        $query = Product::query();
        $filteredProducts = $filter->apply($request->all(),$query);
    }
}
