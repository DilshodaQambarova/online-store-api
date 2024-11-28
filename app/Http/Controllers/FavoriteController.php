<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = Auth()->user()->favorites()->paginate(10);
        return response()->json([
            'favorites' => $favorites,
            'links' => [
                'first' => $favorites->url(1),
                'last' => $favorites->url($favorites->lastPage()),
                'prev' => $favorites->previousPageUrl(),
                'next' => $favorites->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $favorites->currentPage(),
                'from' => $favorites->firstItem(),
                'last_page' => $favorites->lastPage(),
                'path' => $favorites->path(),
                'per_page' => $favorites->perPage(),
                'to' => $favorites->lastItem(),
                'total' => $favorites->total(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);
        Auth()->user()->favorites()->attach($request->product_id);
        return response()->json([
            'message' => 'Product added to favorites'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
            return response()->json([
                'message' => 'Product not found in favorites'
            ], 404);
        }
        Auth::user()->favorites()->detach($id);
        return response()->json([
            'message' => 'Product remove from favorites'
        ]);
    }
}
