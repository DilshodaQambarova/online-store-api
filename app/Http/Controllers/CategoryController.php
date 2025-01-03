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
        return $this->success(CategoryResource::collection($categories));
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->order = $request->order;
        $category->save();
        $uploadedIcon = $this->uploadPhoto($request->hasFile('icon'));
        $category->icon()->create(
            [
                'path' => $uploadedIcon
            ]
        );
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
        $category->order = $request->order;
        $category->save();
        if($request->hasFile('icon')){
            if($category->icon->path){
                $this->deletePhoto($category->icon->path);
            }
            $updatedIcon = $this->uploadPhoto($request->file('icon'));
            $category->icon()->create([
                'path' => $updatedIcon
            ]);
        }
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
        $this->deletePhoto($category->icon->path);
        $category->delete();
        return $this->success([], 'Category deleted successfully', 204);
    }
}
