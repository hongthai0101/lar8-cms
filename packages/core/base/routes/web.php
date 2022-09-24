<?php

use Illuminate\Support\Facades\Route;
use Messi\Base\Http\Controllers\Auth\LoginController;
use Messi\Base\Http\Controllers\Admin\DashboardController;
use Messi\Base\Http\Controllers\Auth\AuthController;
use Messi\Base\Http\Controllers\Admin\SettingController;

Route::group(['namespace' => 'Messi\Base\Http\Controllers\Admin', 'middleware' => ['web']], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['middleware' => 'guest'], function () {

            Route::get('login', [LoginController::class, 'login'])->name('auth.login');
            Route::post('login', [LoginController::class, 'authenticate'])->name('auth.authenticate');
        });

        Route::group(['middleware' => 'auth'], function () {

            Route::get('profile', [AuthController::class, 'profile'])->name('auth.profile');
            Route::post('avatar', [AuthController::class, 'avatar'])->name('user.avatar');
            Route::put('profile', [AuthController::class, 'changeProfile'])->name('auth.profile');
            Route::put('password', [AuthController::class,'password'])->name('auth.password');
            Route::post('logout', [AuthController::class,'logout'])->name('auth.logout');

            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
            Route::resource('users', 'UserController')->only(['index', 'create', 'store', 'destroy', 'show', 'update']);
            Route::resource('roles', 'RoleController');

            //Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
            Route::get('settings/general', [SettingController::class, 'general'])->name('settings.general');
            Route::get('settings/email', [SettingController::class, 'email'])->name('settings.email');
            Route::get('settings/media', [SettingController::class, 'media'])->name('settings.media');
            Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
        });
    });
});
