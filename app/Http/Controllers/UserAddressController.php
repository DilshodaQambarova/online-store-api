<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;

class UserAddressController extends Controller
{

    public function index()
    {
        return Auth::user()->addresses;
    }



    public function store(StoreUserAddressRequest $request)
    {
        Auth()->user()->addresses()->create($request->toArray());
        return response()->json([
            'message' => 'Address created'
        ], 201);
    }

    public function show(UserAddress $userAddress)
    {
        //
    }


    public function update(UpdateUserAddressRequest $request, UserAddress $userAddress)
    {
        //
    }

    public function destroy(UserAddress $userAddress)
    {
        //
    }
}
