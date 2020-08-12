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
    // return view('user.shop');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('stores/{id}/activate', 'StoreController@activate')->name('stores.activate');
    Route::resource('stores', 'StoreController');
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::get('carts/{id}/add', 'CartController@add')->name('carts.add');
    Route::resource('carts', 'CartController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
