<?php

namespace App\Repository\Interfaces;

interface AdminInterface
{
    public function allAdminList();
    public function adminDetails($adminId);
    public function createAdmin($requestData);
}
