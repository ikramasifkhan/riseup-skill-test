<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Repository\Interfaces\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email, 'password' => $request->password
        ];
        if (\auth('user')->attempt($credentials)) {
            $user = auth('user')->user();
            $accessToken = $user->createToken('authToken', ['user'])->accessToken;
            $data = [
                'access_token' => $accessToken,
                'userData' => $user,
            ];
            return \response()->sendSuccess($data, 'User Login Successful', 200);
        }

        return response()->json(['success' => false, 'errors' => 'email or password incorrect',], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function register(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $requestData = $request->except('password');
            $requestData['password'] = bcrypt($request->pasword);
            $user = $this->user->createUser($requestData);
            $accessToken = $user->createToken('authToken')->accessToken;
            DB::commit();
            $data = [
                'userData' => $user,
                'access_token' => $accessToken,
            ];
            return \response()->sendSuccess($data, 'User Registration Successful', 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return \response()->sendErrorWithException($exception, 'OPPS! Something Wrong', 500);
        }
    }
}
