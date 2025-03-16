<?php

namespace App\Repositories\Role;

use App\Models\Role;

class RoleRepository
{
    public function index()
    {
        //
        return Role::paginate(6);
    }

    public function store($role , $permissions)
    {
        //
        try{
            $role = Role::create([
                'role'=>[
                    'ar'=>$role['ar'],
                    'en'=>$role['en'],
                ],
                'permissions'=>json_encode($permissions),
           ]);
           return $role;
        } catch(\Exception $e){
            return false;
        }
    }

    public function edit($id)
    {
        //
        return Role::find($id);
    }

    public function update($id, $role, $permissions)
    {
        //
        try{
            $role = Role::find($id)->update([
                'role'=>[
                    'ar'=>$role['ar'],
                    'en'=>$role['en'],
                ],
                'permissions'=>json_encode($permissions),
           ]);
           return $role;
        } catch(\Exception $e){
            return false;
        }
    }

    public function destroy(string $id)
    {
        //
        return Role::destroy($id);
    }
}
