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
        return view('index');
});

Route::group(['middleware' => 'auth'], function () {
        Route::get('/category', 'CategoryController@index');
        Route::get('/ajax/category', 'CategoryController@fillDatatable')->name('category.data');
        Route::delete('/ajax/category/{id}', 'CategoryController@destroy');
        Route::post('/ajax/category', 'CategoryController@store');
        Route::put('/ajax/category/{id}', 'CategoryController@update');
});

Route::auth();

Route::get('/home', 'HomeController@index');
