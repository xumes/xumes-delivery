<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


Route::group(['prefix'=>'admin', 'middleware'=>'auth.checkrole'], function(){
// Categories
    Route::group(['prefix'=>'categories'], function(){
        Route::get('/', ['as'=>'admin.categories.index', 'uses'=>'CategoryController@index']);
        Route::get('create', ['as'=>'admin.categories.create', 'uses'=>'CategoryController@create']);
        Route::post('store', ['as'=>'admin.categories.store', 'uses'=>'CategoryController@store']);
        Route::get('edit/{id}', ['as'=>'admin.categories.edit', 'uses'=>'CategoryController@edit']);
        Route::post('update/{id}', ['as'=>'admin.categories.update', 'uses'=>'CategoryController@update']);
    });

// Products
    Route::group(['prefix'=>'products'], function(){
        Route::get('/', ['as'=>'admin.products.index', 'uses'=>'ProductController@index']);
        Route::get('create', ['as'=>'admin.products.create', 'uses'=>'ProductController@create']);
        Route::post('store', ['as'=>'admin.products.store', 'uses'=>'ProductController@store']);
        Route::get('edit/{id}', ['as'=>'admin.products.edit', 'uses'=>'ProductController@edit']);
        Route::post('update/{id}', ['as'=>'admin.products.update', 'uses'=>'ProductController@update']);
        Route::get('destroy/{id}', ['as'=>'admin.products.destroy', 'uses'=>'ProductController@destroy']);
    });

    // Clients
    Route::group(['prefix'=>'clients'], function(){
        Route::get('/', ['as'=>'admin.clients.index', 'uses'=>'ClientController@index']);
        Route::get('create', ['as'=>'admin.clients.create', 'uses'=>'ClientController@create']);
        Route::post('store', ['as'=>'admin.clients.store', 'uses'=>'ClientController@store']);
        Route::get('edit/{id}', ['as'=>'admin.clients.edit', 'uses'=>'ClientController@edit']);
        Route::post('update/{id}', ['as'=>'admin.clients.update', 'uses'=>'ClientController@update']);
    });

    // Clients
    Route::group(['prefix'=>'orders'], function(){
        Route::get('/', ['as'=> 'admin.orders.index', 'uses'=>'OrderController@index']);
        Route::get('/{id}', ['as'=> 'admin.orders.edit', 'uses'=>'OrderController@edit']);
        Route::post('update/{id}', ['as'=> 'admin.orders.update', 'uses'=>'OrderController@update']);
    });
});
