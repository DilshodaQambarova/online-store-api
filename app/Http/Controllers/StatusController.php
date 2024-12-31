<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();
        return $this->success($statuses);
    }

    public function store(StoreStatusRequest $request)
    {
        $status = new Status();
        $status->name = $request->name;
        $status->save();
        return $this->success($status, 'Status creatde successfully', 201);
    }


    public function show( $id)
    {
        $status = Status::findOrFail($id);
        return $this->success($status);
    }


    public function update(UpdateStatusRequest $request,  $id)
    {
        $status = Status::findOrFail($id);
        $status->name = $request->name;
        $status->save();
        return $this->success($status, 'Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        //
    }
}
