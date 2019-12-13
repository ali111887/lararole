<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Lararole\Http\Controllers')->group(function () {
    Route::get('access_denied', 'ModuleController@access_denied')->name('access_denied');

    Route::middleware(['web', 'auth', 'permission.read'])->group(function () {
        Route::get('module/{module_slug}', 'ModuleController@index')->name('module.index');
        Route::get('module/{module_slug}/create', 'ModuleController@create')->name('module.create');
        Route::get('module/{module_slug}/{module}', 'ModuleController@show')->name('module.show');
        Route::get('module/{module_slug}/{module}/edit', 'ModuleController@edit')->name('module.edit');
    });
});