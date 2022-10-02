<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Messi\Email\Http\Controllers\Admin', 'middleware' => ['web']], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
        Route::resource('mail-templates', 'MailTemplateController');
        Route::post('mail-templates/field/{id}', 'MailTemplateController@field')->name('mail-templates.field');
    });
});
