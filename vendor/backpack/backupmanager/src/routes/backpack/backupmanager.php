<?php

/*
|--------------------------------------------------------------------------
| Backpack\BackupManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\BackupManager package.
|
*/

Route::group([
    'namespace'  => 'Backpack\BackupManager\app\Http\Controllers',
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', 'admin'],
], function () {
    Route::get('backup', 'BackupController@index');
    Route::put('backup/create', 'BackupController@create');
    Route::get('backup/download/{file_name?}', 'BackupController@download');
    Route::delete('backup/delete/{file_name?}', 'BackupController@delete')->where('file_name', '(.*)');
});
