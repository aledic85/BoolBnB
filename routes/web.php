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
Route::post('/contactUser/{userId}/apartment/{apartId}', 'GeneralController@sendMail')->name('send.mail');
Route::get('/search', 'GeneralController@searchApartments')->name('search.apart');
Route::get('/search/results', 'GeneralController@resultsApartments')->name('search.results');
Route::get('/search_by_city', 'GeneralController@searchByCityResults')->name('search.by.city');

Auth::routes();

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/dashboard/create', 'HomeController@createApartment')->name('new.apart');
Route::post('/dashboard/store', 'HomeController@storeApartment')->name('store.new.apart');
Route::delete('/dashboard/delete/{id}', 'HomeController@deleteApartment')->name('delete.apart');
Route::get('/dashboard/edit/{id}', 'HomeController@editApartment')->name('edit.apart');
Route::post('/dashboard/update/{id}', 'HomeController@updateApartment')->name('update.apart');
Route::get('/dashboard/received_messages', 'HomeController@receivedMessages')->name('received.messages');
Route::get('/dashboard/sponsorize/{id}', 'HomeController@sponsorizeApartment')->name('spons.apart');
Route::get('/dashboard/payment/process', 'HomeController@paymentProcess')->name('payment.process');
Route::get('/dashboard/payment/success/{id}', 'HomeController@paymentSuccess')->name('payment.success');
Route::view('/dashboard/sponsorship-success', 'page.sponsorship-success');
Route::get('/dashboard/apartment/stats/{id}', 'HomeController@showStats')->name('apart.stats');
Route::delete('/dashboard/received_messages/delete/{id}', 'HomeController@deleteMessages')->name('delete.mess');
