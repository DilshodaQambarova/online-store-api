<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return $this->success($roles);
    }

    public function store(StoreRoleRequest $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return $this->success($role, 'ROle Created successfully', 201);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return $this->success($role);
    }

    public function update(UpdateRoleRequest $request, Role $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        return $this->success($role, 'Role updated successfully');
    }


    public function destroy( $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return $this->success([], 'ROle deleted successfully', 204);
    }
}
