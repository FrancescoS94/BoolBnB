<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Flat;
use App\Payment;
use Carbon\Carbon;

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
    Route::resource('users','UserController');
    Route::resource('flats','FlatController');
    Route::resource('addresses','AddressController');
    Route::resource('payments','PaymentController');
    Route::resource('messages','MessageController'); 
});

// rotte accessibili a tutti senza autenticazione
Route::get('/', 'HomeController@index')->name('home');
Route::resource('flats','FlatController'); // rotte per la pagina searche e per gli show dei flat
Route::resource('messages','MessageController');

// rotte e controller per chartjs
Route::get('/get-messages-chart-data', 'Admin\MessagesChartDataController@getMonthlyMessagesData');
