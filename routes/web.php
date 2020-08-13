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
    return view('auth.login');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('stores/{id}/activate', 'StoreController@activate')->name('stores.activate');
    Route::resource('stores', 'StoreController');
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
});

Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('carts/{id}/add', 'CartController@add')->name('carts.add');
    Route::get('carts/{id}/incerement_quantity', 'CartController@increment_quantity')->name('carts.increment_quantity');
    Route::get('carts/{id}/decrement_quantity', 'CartController@decrement_quantity')->name('carts.decrement_quantity');
    Route::resource('carts', 'CartController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
