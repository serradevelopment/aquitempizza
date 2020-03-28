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
Route::get('/', 'IndexController@index')->name('index');
	Auth::routes();

Route::namespace('Admin')->prefix('admin')->group(function(){
	\BeautifulSea\LaravelRamodnil\LaravelRamodnilServiceProvider::routes();
	Route::get('/', 'HomeController@index')->name('home');

	Route::get('/products/lock/{product}', 'ProductsController@lock')->name('products.block');
	Route::get('/products/unlock/{product}', 'ProductsController@unlock')->name('products.unblock');

	Route::resource('/products','ProductsController');
});
