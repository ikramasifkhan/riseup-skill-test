<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $admin = auth('admin')->user();
            $accessToken = $admin->createToken('authToken',['admin'])->accessToken;
            $data = [
                'access_token' => $accessToken,
                'adminData' => $admin,
            ];
            return \response()->sendSuccess($data, 'Admin Login Successful', 200);
        }

        return response()->json(['success' => false, 'errors' => 'email or password incorrect',], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
