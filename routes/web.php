<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();



// rotte accessibili agli user
Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('users','UserController');
    Route::resource('flats','FlatController');
    Route::resource('addresses','AddressController');
    Route::resource('payments','PaymentController');
    Route::resource('messages','MessageController');
});

// rotte accessibili a tutti senza autenticazione
Route::get('/home', 'FlatController@index')->name('home');
Route::get('/search', 'FlatController@index')->name('search');
Route::get('/show/{id}', 'FlatController@show')->name('flat');

Route::get('/', function () {
    return view('welcome'); /// formare index
});

