<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/', 'DefaultController@index');

Route::get('/manager', 'ManagerController@index')->name('managerIndex');
Route::get('/manager/project', 'ManagerController@project')->name('managerProject');
Route::get('/manager/project/{id}/edit', 'ManagerController@edit')->where('id', '[0-9]+')->name('managerProjectEdit');
Route::get('/manager/project/{id}/disable', 'ManagerController@disable')->where('id', '[0-9]+')->name('managerProjectDisable');
Route::get('/manager/project/{id}/remove_image/{image}', 'ManagerController@removeImage')->where('id', '[0-9]+')->where('image', '.*')->name('managerProjectRemoveImage');
Route::get('/manager/project', 'ManagerController@project')->name('managerProject');
Route::post('/manager/process', 'ManagerController@process')->name('managerProcess');