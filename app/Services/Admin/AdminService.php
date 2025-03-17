<?php

namespace App\Services\Admin;

use App\Repositories\Admin\AdminRepository;

class AdminService
{
    protected $adminRepository;
    public function __construct(AdminRepository $adminRepository)
    {
        //
        $this->adminRepository = $adminRepository;
    }
    
    public function getAdmins()
    {
        return $this->adminRepository->getAdmins();
    }

    public function getRoles(){
        return $this->adminRepository->getRoles();
    }

    public function store($request)
    {
        return $this->adminRepository->store($request);
    }

    public function edit($id)
    {
        return $this->adminRepository->edit($id);
    }

    public function update($request, $id)
    {
        return $this->adminRepository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->adminRepository->destroy($id);
    }

    public function status($id){
        return $this->adminRepository->status($id);
    }

    public function search($key){
        
        return $this->adminRepository->search($key);
    }
}
