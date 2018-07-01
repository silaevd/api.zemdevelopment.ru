<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/', 'ManagerController@index')->name('managerIndex');

Route::get('/manager', 'ManagerController@index')->name('managerIndex');
Route::get('/manager/project', 'ManagerController@project')->name('managerProject');
Route::get('/manager/project/{id}/edit', 'ManagerController@edit')->where('id', '[0-9]+')->name('managerProjectEdit');
Route::get('/manager/project/{id}/disable', 'ManagerController@disable')->where('id', '[0-9]+')->name('managerProjectDisable');
Route::get('/manager/project/{id}/enable', 'ManagerController@enable')->where('id', '[0-9]+')->name('managerProjectEnable');
Route::get('/manager/project/{id}/cover_remove', 'ManagerController@coverRemove')->where('id', '[0-9]+')->name('managerProjectCoverRemove');
Route::get('/manager/project/{id}/remove_image/{image}', 'ManagerController@removeImage')->where('id', '[0-9]+')->where('image', '.*')->name('managerProjectRemoveImage');
Route::get('/manager/project', 'ManagerController@project')->name('managerProject');
Route::post('/manager/process', 'ManagerController@process')->name('managerProcess');
Route::post('/manager/contact/save', 'ContactController@save')->name('contactSave');
Route::post('/manager/slider/process', 'ManagerController@sliderUpload')->name('managerSliderUpload');
Route::get('/manager/slider/{id}/delete', 'ManagerController@sliderRemove')->where('id', '[0-9]+')->name('managerSliderDelete');
