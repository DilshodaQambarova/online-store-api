<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;

class FavoriteController extends Controller
{
   
    public function index()
    {
        $favorites = Auth()->user()->favorites()->paginate(10);
        return $this->responsePagination($favorites, ProductResource::collection($favorites));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);
        $id = $request->product_id;
        $favorites = Auth::user()->favorites();
        $favorites->attach($id);
        return $this->success([], 'Product added to favorites', 201);
    }

    public function show(string $id)
    {
       $favorite = Auth::user()->favorites()->find($id);
       if(!$favorite){
        return $this->error('Product not found', 404);
       }
       return $this->success(new ProductResource($favorite));
    }

    public function destroy(string $id)
    {
        if(!Auth::user()->hasFavorite($id)){
            return $this->error('Product not found in favorites', 404);
        }
        Auth::user()->favorites()->detach($id);
        return $this->success([], 'Product remove from favorites', 204);
    }
}
