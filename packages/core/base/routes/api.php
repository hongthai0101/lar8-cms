<?php

use Illuminate\Support\Facades\Route;;
use Messi\Base\Http\Controllers\Api\AuthController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/v1',
    'as' => 'api.'
], function () {

    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
    });

    Route::group(['prefix' => 'auth', 'as' => 'auth.', 'middleware' => 'jwt.verify'], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    });

    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('jwt.refresh')->name('refresh');
});