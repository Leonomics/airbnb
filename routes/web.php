<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/admin', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
    Route::resource('apartments', 'ApartmentController');
    Route::get('/messages/{apartment_id}', 'MessageController@index')->name('messages.index');
    Route::get('/messages/{apartment}/message/{message}', 'MessageController@show')->name('messages.show');
    Route::resource('users', 'UserController')->only(['show', 'update', 'edit', 'destroy']);
    Route::resource('images', 'ImageController');

    Route::get('/home', 'HomeController@index')->name('home');

});

Route::get('/{any?}', function () {
    return view('guest.home');
})->where('any', '.*');