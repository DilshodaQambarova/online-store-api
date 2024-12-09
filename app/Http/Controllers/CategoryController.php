<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return $this->responsePagination($categories, CategoryResource::collection($categories));
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->order = $request->order;
        $category->save();
        return $this->success(new CategoryResource($category), 'Category created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        if(!$category){
            return $this->error('Category not found', 404);
        }
        return $this->success($category);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        if(!$category){
            return $this->error('Category not found', 404);
        }
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->order = $request->order;
        $category->save();
        return $this->success($category, 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category){
            return $this->error('Category not found', 404);
        }
        $category->delete();
        return $this->success([], 'Category deleted successfully', 204);
    }
}
