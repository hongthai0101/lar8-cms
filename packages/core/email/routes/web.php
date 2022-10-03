<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Messi\Email\Http\Controllers\Admin', 'middleware' => ['web']], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
        Route::get('mail-templates/suggest-fillable', 'MailTemplateController@suggestFillable')->name('mail-templates.suggest-fillable');
        Route::resource('mail-templates', 'MailTemplateController');
        Route::post('mail-templates/field/{id}', 'MailTemplateController@field')->name('mail-templates.field');
        Route::post('mail-templates/test-send/{id}', 'MailTemplateController@testSend')->name('mail-templates.test-send');

        Route::get('mail-setting', 'MailSettingController@index')->name('mail-setting.index');
        Route::post('mail-setting', 'MailSettingController@update')->name('mail-setting.update');
    });
});
