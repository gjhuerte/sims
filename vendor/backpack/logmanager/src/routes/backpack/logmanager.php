<?php

/*
|--------------------------------------------------------------------------
| Backpack\LogManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\LogManager package.
|
*/

Route::group([
            'namespace'  => 'Backpack\LogManager\app\Http\Controllers',
            'middleware' => ['web', 'admin'],
            'prefix'     => config('backpack.base.route_prefix', 'admin'),
    ], function () {
        Route::get('log', 'LogController@index');
        Route::get('log/preview/{file_name}', 'LogController@preview');
        Route::get('log/download/{file_name}', 'LogController@download');
        Route::delete('log/delete/{file_name}', 'LogController@delete');
    });
