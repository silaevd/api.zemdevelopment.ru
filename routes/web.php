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
Route::post('/manager/process', 'ManagerController@process')->name('managerProcess');