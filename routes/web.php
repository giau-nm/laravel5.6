<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::resource('configs', 'ConfigController');
Route::get('configs', 'ConfigController@index')->name('configs.index');
Route::post('configs/udpate/{id}', 'ConfigController@update')->name('configs.update');
Route::get('searchs/index', 'SearchController@index')->name('searchs.index');