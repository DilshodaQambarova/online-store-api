<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index($id){
        return Category::with('products')->cursorPaginate(10)->findOrFail($id);
    }
}
