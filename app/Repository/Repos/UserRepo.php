<?php

namespace App\Repository\Repos;

use App\Models\User;
use App\Repository\Interfaces\UserInterface;

class UserRepo implements UserInterface
{

    public function createUser($requestData)
    {
        return User::create($requestData);
    }
}
