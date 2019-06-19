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

Route::get('/', 'GeneralController@index')->name('home');
Route::get('/show/{id}', 'GeneralController@showApartment')->name('show.apart');

Auth::routes();

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/dashboard/new', 'HomeController@createApartment')->name('new.apart');
Route::post('/dashboard/new', 'HomeController@storeApartment')->name('store.new.apart');
Route::delete('/dashboard/delete/{id}', 'HomeController@deleteApartment')->name('delete.apart');
Route::get('/dashboard/edit/{id}', 'HomeController@editApartment')->name('edit.apart');
Route::post('/dashboard/update/{id}', 'HomeController@updateApartment')->name('update.apart');
