<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('orders/generate', 'Api\Orders\OrderController@generate');

Route::post('orders/make/payment', 'Api\Orders\OrderController@makePayment');

Route::get('sponsors', 'Api\Sponsors\SponsorController@index');

Route::get('search/{input}', 'Api\Search\SearchInputController@index');

Route::get('apartments/index/{type}', 'Api\Apartments\ApartmentController@index');
Route::get('apartments/{apartment}', 'Api\Apartments\ApartmentController@show');

Route::get('services/index/{type}', 'Api\Services\ServiceController@index');
Route::get('services/{services}', 'Api\Services\ServiceController@show');

Route::resource('messages', 'Api\MessageController')->only('store');