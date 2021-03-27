<?php

use App\Http\Controllers\Api\Auth\ChangePasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Auth\LogoutController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);

Route::group(['middleware' => 'auth:api'], function () {
    Route::patch('users/change-password', ChangePasswordController::class);
    Route::patch('users/profile', [UsersController::class, 'update']);
    Route::post('logout', LogoutController::class);

    Route::post('posts', [PostController::class, 'store']);

    Route::patch('posts/{post}', [PostController::class, 'update']);
    Route::get('posts/{post}', [PostController::class, 'show']);
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
    Route::get('posts', [PostController::class, 'index']);
});
