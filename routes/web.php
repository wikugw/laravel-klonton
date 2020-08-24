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
    Route::get('stores/{id}/products', 'StoreController@store_products')->name('stores.products');
    Route::get('stores/{id}/banks', 'StoreController@store_banks')->name('stores.banks');
    Route::get('store/{id}/transactions', 'StoreController@transactions')->name('stores.transactions');
    Route::resource('stores', 'StoreController');
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::resource('users', 'UserController');
    Route::resource('addresses', 'AddressController');
    Route::resource('store_banks', 'StoreBankController');
    Route::get('transactions/{id}/confirm', 'TransactionController@confirm')->name('transactions.confirm');
    Route::get('transactions/{id}/resi', 'TransactionController@resi')->name('transactions.resi');
    Route::put('transactions/{id}/add_resi', 'TransactionController@add_resi')->name('transactions.add_resi');
    Route::get('transactions/export', 'TransactionController@export')->name('transactions.export');
    Route::resource('transactions', 'TransactionController');
});

Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('carts/{id}/add', 'CartController@add')->name('carts.add');
    Route::get('carts/{id}/incerement_quantity', 'CartController@increment_quantity')->name('carts.increment_quantity');
    Route::get('carts/{id}/decrement_quantity', 'CartController@decrement_quantity')->name('carts.decrement_quantity');
    Route::post('carts/{id}/checkout', 'CartController@checkout')->name('carts.checkout');
    Route::delete('carts/{id}/delete_address/{address_id}', 'CartController@delete_address')->name('carts.delete_address');
    Route::get('carts/{id}/checkout/{address_id}/{courier}', 'CartController@ongkir')->name('carts.checkout.ongkir');
    Route::post('carts/{id}/checkout/{address_id}/{courier}/pay', 'CartController@pay')->name('carts.checkout.pay');
    Route::resource('carts', 'CartController');
});

Auth::routes();

Route::get('/getCity/ajax/{id}', 'HomeController@getCitiesAjax');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/stores', 'HomeController@stores')->name('home.stores');
Route::get('/home/stores/{id}', 'HomeController@store')->name('home.store');
Route::get('/home/{id}', 'HomeController@category')->name('home.category');
Route::get('/success', 'HomeController@success')->name('home.success');
Route::get('/transactions', 'HomeController@transactions')->name('home.transactions');
Route::get('/receive/{id}', 'HomeController@receive')->name('home.receive');
