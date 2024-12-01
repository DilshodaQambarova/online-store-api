<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = Auth()->user()->favorites()->paginate(10);
        return $this->responsePagination($favorites, ProductResource::collection($favorites));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $favorite = Auth::user()->favorites()->find($id);
       if(!$favorite){
        return $this->error('Product not found', 404);
       }
       return $this->success(new ProductResource($favorite));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Auth::user()->hasFavorite($id)){
            return $this->error('Product not found in favorites', 404);
        }
        Auth::user()->favorites()->detach($id);
        return $this->success([], 'Product remove from favorites', 204);
    }
}
