<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AddressResource;
use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;

class UserAddressController extends Controller
{

    public function index()
    {
        $addresses = Auth::user()->addresses;
        return $this->success(AddressResource::collection($addresses));
    }



    public function store(StoreUserAddressRequest $request)
    {
        $address = Auth()->user()->addresses()->create($request->toArray());
        return $this->success(new AddressResource($address), 'Address created', 201);
    }

    public function show($id)
    {
        $address = UserAddress::find($id);
        if(!$address){
            return $this->error('Address not found', 404);
        }
        return $this->success($address);
    }


    public function update(UpdateUserAddressRequest $request, $id)
    {
        $userAddress = UserAddress::find($id);
        if(!$userAddress){
            return $this->error('This address not found', 404);
        }
        $userAddress->latitude = $request->latitude;
        $userAddress->longitude = $request->longitude;
        $userAddress->region = $request->region;
        $userAddress->district = $request->district;
        $userAddress->street = $request->street;
        $userAddress->home = $request->home;
        $userAddress->save();
        return $this->success(new AddressResource($userAddress), 'Address updated');
    }

    public function destroy($id)
    {
        $userAddress = UserAddress::find($id);
        if(!$userAddress){
            return $this->error('Address not found', 404);
        }
        $userAddress->delete();
        return $this->success([], 'Address deleted', 204);
    }
}
