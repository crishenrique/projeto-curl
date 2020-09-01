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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/capturar', 'CapturarController@index')->name('capturar');
Route::post('/capturar/store', 'CapturarController@storecarros')->name('capturar.store');
Route::post('/capturar/destroy/{id}', 'CapturarController@destroy')->name('capturar.destroy');
