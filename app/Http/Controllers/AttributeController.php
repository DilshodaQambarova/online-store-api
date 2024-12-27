<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return $this->responsePagination($attributes, $attributes);
    }

    public function store(StoreAttributeRequest $request)
    {
        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->save();
        return $this->success($attribute, 'Attribute created successfully', 201);
    }

    public function show( $id)
    {
        $attribute = Attribute::findOrFail($id);
        return $this->success($attribute);
    }


    public function update(UpdateAttributeRequest $request,  $id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->name = $request->name;
        $attribute->save();
        return $this->success($attribute, 'Attribute updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
