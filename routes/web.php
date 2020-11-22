<?php

use Illuminate\Support\Facades\Route;
use App\Flat;

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


Route::get('/pagamenti', function(){


    //return view('pagamenti');
});

/* $gateway = new Braintree\Gateway([
    'environment' => config('services.braintree.environment'),
    'merchantId' => config('services.braintree.merchantId'),
    'publicKey' => config('services.braintree.publicKey'),
    'privateKey' => config('services.braintree.privateKey')
]);

$token = $gateway->ClientToken()->generate();

return view('welcome', [
    'token' => $token
]); */