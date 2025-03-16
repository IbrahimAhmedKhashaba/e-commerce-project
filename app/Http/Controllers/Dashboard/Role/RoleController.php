<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Services\Role\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    public function index()
    {
        //
        $roles = $this->roleService->index();
        return view('dashboard.roles.index', compact('roles'));
    }

    public function create()
    {
        //
        return view('dashboard.roles.create');
    }

    public function store(RoleRequest $request)
    {
        //
        $role = $this->roleService->store($request->role , $request->permissions);
        if(!$role){
            return redirect()->back()->with('error', 'Something went wrong');
        }
        return redirect()->route('dashboard.roles.index')->with('success', 'Role created successfully');
    }

    public function edit(string $id)
    {
        //
        $role = $this->roleService->edit($id);
        if(!$role){
            return redirect()->back()->with('error', 'Something went wrong');
        }
        return view('dashboard.roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, string $id)
    {
        //
        $role = $this->roleService->update($id, $request->role, $request->permissions);
        if(!$role){
            return redirect()->back()->with('error', 'Something went wrong');
        }
        return redirect()->route('dashboard.roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy(string $id)
    {
        //
        $this->roleService->destroy($id);
        return redirect()->route('dashboard.roles.index')->with('success', 'Role deleted successfully');
    }
}
