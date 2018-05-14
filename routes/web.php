<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/manager', 'ManagerController@index')->name('managerIndex');
Route::get('/manager/form', 'ManagerController@form')->name('managerForm');
Route::post('/manager/process', 'ManagerController@form')->name('managerProcess');
