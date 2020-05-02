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
Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm')->name('logins');

Route::get('/defadress', 'UserController@defadd')->name('getdefadd');
Route::patch('/setadress', 'UserController@setadd')->name('setdefadd');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/pilihan/{id_category}/search', 'ProductController@search')->name('product.search');

Route::resource('users', 'UserController');
Route::resource('cat', 'CategoryController');
Route::resource('product', 'ProductController');
Route::resource('order', 'OrderController');
Route::resource('detail', 'OrderDetailController');

Route::get('/layouts/admin/category/index', 'CategoryController@i_admin')->name('cat.i_admin');
Route::get('/layouts/admin/product/index', 'ProductController@i_admin')->name('product.i_admin');

// PRODUCT BERDASARKAN CATEGORY
Route::get('/product/pilihan/{id_category}', 'ProductController@indexPilihan')->name('product.pilihan');

// CART ROUTES
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/add/', 'CartController@add')->name('cart.add');
Route::delete('/cart/delete/{id_product}', 'CartController@remove')->name('cart.remove');
Route::patch('/cart/update', 'CartController@update')->name('cart.update');
Route::post('/cart', 'CartController@order')->name('cart.order');
Route::get('/cart/live', 'CartController@cartlive')->name('cart.live');

// CEK RIWAYAT
Route::get('/riwayat', 'HomeController@riwayat')->name('riwayat.index');
Route::get('/riwayat/{id_order}', 'HomeController@detailRiwayat')->name('riwayat.detail');


// ADMIN ROUTES
Route::group(['middleware' => 'checkadmin'], function () {
    Route::get('/admins', 'AdminController@index')->name('admins.index');

// USERS
    Route::get('/admins/users', 'AdminController@userIndex')->name('admins.users.index');
    Route::post('/admins/users', 'AdminController@userStore')->name('admins.users.store');
    Route::get('/admins/users/{id_user}/edit', 'AdminController@userEdit')->name('admins.users.edit');
    Route::put('/admins/users/{id_user}', 'AdminController@userUpdate')->name('admins.users.update');
    Route::delete('/admins/users/{id_user}', 'AdminController@userDestroy')->name('admins.users.destroy');

// CATEGORY
    Route::get('/admins/category', 'AdminController@categoryIndex')->name('admins.category.index');
    Route::post('/admins/category', 'AdminController@categoryStore')->name('admins.category.store');
    Route::get('/admins/category/{id_category}/edit', 'AdminController@categoryEdit')->name('admins.category.edit');
    Route::put('/admins/category/{id_category}', 'AdminController@categoryUpdate')->name('admins.category.update');
    Route::delete('/admins/category/{id_category}', 'AdminController@categoryDestroy')->name('admins.category.destroy');

// PRODUCT
    Route::get('/admins/product', 'AdminController@productIndex')->name('admins.product.index');
    Route::post('/admins/product', 'AdminController@productStore')->name('admins.product.store');
    Route::get('/admins/product/{id_product}/edit', 'AdminController@productEdit')->name('admins.product.edit');
    Route::put('/admins/product/{id_product}', 'AdminController@productUpdate')->name('admins.product.update');
    Route::delete('/admins/product/{id_product}', 'AdminController@productDestroy')->name('admins.product.destroy');

// ORDER
    Route::get('/admins/order', 'AdminController@orderIndex')->name('admins.order.index');
    Route::put('/admins/order/{id_order}', 'AdminController@orderComplete')->name('admins.order.complete');
    Route::delete('/admins/order/{id_order}', 'AdminController@orderDestroy')->name('admins.order.destroy');

    Route::get('/admins/order/detail/{id_order}', 'AdminController@orderDetail')->name('admins.order.detail');
});
