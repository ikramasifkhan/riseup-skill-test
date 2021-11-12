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
        return Admin::findOrFail($adminId);
    }

    public function createAdmin($requestData){
        return Admin::create($requestData);
    }
}
