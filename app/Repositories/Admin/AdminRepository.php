<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Session;

class AdminRepository
{

    public function __construct() {}

    public function getAdmins()
    {
        return Admin::select('id' , 'name' , 'email' , 'role_id' , 'status' , 'created_at')->with('role')
        ->when(request()->key , function($query){
            $query->where('name' , 'like' , '%'.request()->key.'%');
        })->paginate(6);
    }

    public function getAdmin($id){
        return Admin::find($id);
    }

    public function getRoles()
    {
        return Role::all();
    }

    public function store($request)
    {
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'status' => $request->status,
        ]);
        return $admin;
    }

    public function edit($id)
    {
        $admin = $this->getAdmin($id);
        $roles = $this->getRoles();
        if (!$admin) {
            Session::flash('error', 'Admin Not Found');
            return false;
        }
        if (!$roles) {
            Session::flash('error', 'Roles Not Found, Add one role at least');
            return false;
        }
        return [
            'admin' => $admin,
            'roles' => $roles,
        ];
    }

    public function update($request, $id)
    {
        $admin = $this->getAdmin($id);
        if (!$admin) {
            return false;
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $request->password ?? $admin->password = bcrypt($request->password);
        $admin->role_id = $request->role_id;
        $admin->status = $request->status;
        $admin->save();
        return true;
    }

    public function destroy($id)
    {
        $admin = $this->getAdmin($id);
        if (!$admin) {
            return false;
        }
        $admin->delete();
        return true;
    }

    public function status($id)
    {
        $admin = $this->getAdmin($id);
        if (!$admin) {
            return false;
        }
        $admin->status = $admin->status == 'Active' ? 0 : 1;
        $admin->save();
        return true;
    }

    public function search($key){
        if($key == 'all'){
            return Admin::with('role')->paginate(6);
        }
        return Admin::where('name', 'like', '%'.$key.'%')->orWhere('email', 'like', '%'.$key.'%')->with('role')->get();
    }
}
