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
            return $this->error(__('errors.category.not_found'), 404);
        }
        $product = $category->products()->create([
            'category_id' => $category->id,
            'name' => $request->name,
            'description' => $request->description
        ]);
        $product->status->name = $request->status;
        $product->status()->save();
        $uploadedImage = $this->uploadPhoto($request->hasFile('images'));
        $product->images()->create([
            'path' => $uploadedImage
        ]);
        return $this->success($product, __('successes.product.created'), 201);
    }

    public function show($id)
    {
        $product = Product::with('stocks', 'category')->findOrFail($id);
        return $this->success(new ProductResource($product));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        $product->status->name = $request->status;
        $product->status()->save();
        if($request->hasFile('images')){
            if($product->images->path){
                $this->deletePhoto($product->images->path);
            }
            $updatedImages = $this->uploadPhoto($request->file('images'));
            $product->images()->create([
                'path' => $updatedImages
            ]);
        }
        return $this->success($product, __('successes.product.updated'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->deletePhoto($product->images->path);
        $product->delete();
        return $this->success([], __('successes.product.deleted'), 204);
    }
    public function productFilter(FilterProductRequest $request){
        $filter = new ProductFilter();
        $query = Product::query();
        $filteredProducts = $filter->apply($request->all(),$query);
        return $this->responsePagination($filteredProducts, ProductResource::collection($filteredProducts));
    }
    public function search(Request $request){
        $filter = new ProductFilter();
        $query = Product::query();
        $filteredProducts = $filter->apply($request->all(),$query);
        $searchedProducts = $filteredProducts->where('name', 'like', $request->q);
        return $this->responsePagination($searchedProducts, ProductResource::Collestion($searchedProducts));
    }
}
