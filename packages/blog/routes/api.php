<?php

use Illuminate\Support\Facades\Route;;
use Messi\Blog\Http\Controllers\Api\CategoryController;

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

    Route::group(['prefix' => '', 'as' => 'blog.', 'middleware' => 'jwt.verify'], function () {
        Route::resource('categories', CategoryController::class);
    });
});
