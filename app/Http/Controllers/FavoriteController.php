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
        return $this->success([], __('successes.favorite.added'), 201);
    }

    public function show(string $id)
    {
       $favorite = Auth::user()->favorites()->findOrFail($id);
       return $this->success(new ProductResource($favorite));
    }

    public function destroy(string $id)
    {
        if(!Auth::user()->hasFavorite($id)){
            return $this->error(__('successes.favorite.not_found'), 404);
        }
        Auth::user()->favorites()->detach($id);
        return $this->success([], __('successes.favorite.removed'), 204);
    }
}
