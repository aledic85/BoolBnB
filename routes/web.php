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
Route::post('/contactUser/{id}', 'GeneralController@sendMail')->name('send.mail');
Route::get('/search', 'GeneralController@searchApartments')->name('search.apart');
Route::get('/search/results', 'GeneralController@resultsApartments')->name('search.results');

Auth::routes();

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/dashboard/create', 'HomeController@createApartment')->name('new.apart');
Route::post('/dashboard/store', 'HomeController@storeApartment')->name('store.new.apart');
Route::delete('/dashboard/delete/{id}', 'HomeController@deleteApartment')->name('delete.apart');
Route::get('/dashboard/edit/{id}', 'HomeController@editApartment')->name('edit.apart');
Route::post('/dashboard/update/{id}', 'HomeController@updateApartment')->name('update.apart');
