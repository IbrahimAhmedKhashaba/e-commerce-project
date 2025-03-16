<?php

namespace App\Services\Role;

use App\Repositories\Role\RoleRepository;

class RoleService
{
    protected $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        //
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        //
        return $this->roleRepository->index();
    }

    public function store($role , $permissions)
    {
        //
        return $this->roleRepository->store($role , $permissions);
    }

    public function edit($id)
    {
        //
        return $this->roleRepository->edit($id);
    }

    public function update($id, $role, $permissions)
    {
        //
        return $this->roleRepository->update($id, $role, $permissions);
    }

    public function destroy(string $id)
    {
        //
        return $this->roleRepository->destroy($id);
    }
}
