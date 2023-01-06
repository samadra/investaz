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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('welcome');
});
Route::resource('/bord', 'App\Http\Controllers\BordController');

Route::get('/bord/{id}/payouts', 'App\Http\Controllers\BordController@payouts')
    ->name('bord.payouts');
Route::post('/bord/{id}/order', 'App\Http\Controllers\OrderController@create')
    ->name('bord.order');
Route::post('/bond/order/{order_id}', 'App\Http\Controllers\OrderController@interestPayments');
