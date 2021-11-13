<?php

namespace App\Repository\Repos;

use App\Models\Admin;
use App\Repository\Interfaces\AdminInterface;

class AdminRepo implements AdminInterface
{

    public function allAdminList()
    {
        return Admin::latest()->get();
    }

    public function adminDetails($adminId)
    {
        return Admin::with('posts')->findOrFail($adminId);
    }

    public function createAdmin($requestData){
        return Admin::create($requestData);
    }

    public function updateAdmin($requestData, $adminData){
        return $adminData->update($requestData);
    }

    public function deleteAdmin($adminData){
        return $adminData->delete();
    }
}
