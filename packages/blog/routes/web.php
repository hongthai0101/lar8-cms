<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Messi\Blog\Http\Controllers\Admin', 'middleware' => ['web']], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::group(['middleware' => 'auth'], function () {
            Route::resource('posts', 'PostController');
            Route::resource('categories', 'CategoryController');
            Route::resource('tags', 'TagController');
            Route::resource('galleries', 'GalleryController');
        });
    });
});
