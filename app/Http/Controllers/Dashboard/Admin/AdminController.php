<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Services\Admin\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    protected $adminService;
    public function __construct(AdminService $adminService){
        $this->adminService = $adminService;
    }
    public function index()
    {
        //
        $admins = $this->adminService->getAdmins();
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = $this->adminService->getRoles();
        return view('dashboard.admins.create' , compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        //
        if(!$this->adminService->store($request)){
            Session::flash('error', 'Admin Not Created Successfully');
        }
            Session::flash('success', 'Admin Created Successfully');
            return redirect()->route('dashboard.admins.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = $this->adminService->edit($id);
        if(!$data){
            return redirect()->route('dashboard.admins.index');
        }
        $admin = $data['admin'];
        $roles = $data['roles'];
        return view('dashboard.admins.edit', compact('admin' , 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        //
        $admin = $this->adminService->update($request, $id);
        if(!$admin){
            Session::flash('error', 'Admin Not Updated Successfully');
        }
            Session::flash('success', 'Admin Updated Successfully');
            return redirect()->route('dashboard.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $admin = $this->adminService->destroy($id);
        if(!$admin){
            Session::flash('error', 'Admin Not Deleted Successfully');
        }
            Session::flash('success', 'Admin Deleted Successfully');
            return redirect()->route('dashboard.admins.index');
    }

    public function status($id)
    {
        //
        $admin = $this->adminService->status($id);
        if(!$admin){
            Session::flash('error', 'Admin not found');
        }
        Session::flash('success', 'Admin status updated successfully');
        return redirect()->back();
    }

    public function search($key){
        $admins = $this->adminService->search($key);
        return response()->json($admins);
    }
}
