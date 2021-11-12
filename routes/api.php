<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1/admin','as'=>'admin.'],function (){

    Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login']);
    Route::group(['middleware' => ['auth:admin-api']],function (){
        Route::post('logout',[\App\Http\Controllers\Admin\AuthController::class,'logout']);
        Route::apiResource('admins', \App\Http\Controllers\Admin\AdminController::class);
        Route::apiResource('posts', \App\Http\Controllers\Admin\PostController::class);
    });

});
Route::group(['prefix' => 'v1','as'=>'user.'],function (){
    Route::post('login', [\App\Http\Controllers\User\AuthController::class, 'login']);
    Route::post('registration', [\App\Http\Controllers\User\AuthController::class, 'register']);
    Route::group(['middleware' => ['auth:user-api'], 'prefix'=>'user'],function (){
        Route::post('logout',[\App\Http\Controllers\User\AuthController::class,'logout']);
        Route::apiResource('posts', \App\Http\Controllers\User\PostController::class);
    });

});
