<?php

Route::get('/', function () {
        return view('index');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/category', 'CategoryController@index')->name('category.index');
    Route::get('/ajax/category', 'CategoryController@fillDatatable')->name('category.data');
    Route::delete('/ajax/category/{id}', 'CategoryController@destroy');
    Route::post('/ajax/category', 'CategoryController@store');
    Route::put('/ajax/category/{id}', 'CategoryController@update');
    Route::get('/ajax/category/{id}/items', 'ItemController@getItemByCategoryId');


    Route::get('/item', 'ItemController@index')->name('item.index');
    Route::get('/ajax/item', 'ItemController@fillDatatable');
    Route::get('/item/{id}/edit', 'ItemController@edit');
    Route::put('/item/{id}', 'ItemController@update')->name('item.update');
    Route::delete('/ajax/item/{id}', 'ItemController@destroy');
    Route::get('/item/create', 'ItemController@create')->name('item.create');
    Route::post('/item', 'ItemController@store')->name('item.store');

    Route::get('/customer', 'CustomerController@index')->name('customer.index');
    Route::get('/ajax/customer', 'CustomerController@fillDatatable')->name('customer.data');
    Route::delete('/ajax/customer/{id}', 'CustomerController@destroy');
    Route::post('/ajax/customer', 'CustomerController@store');
    Route::put('/ajax/customer/{id}', 'CustomerController@update');

    Route::get('/supplier', 'SupplierController@index')->name('supplier.index');
    Route::get('/ajax/supplier', 'SupplierController@fillDatatable')->name('supplier.data');
    Route::delete('/ajax/supplier/{id}', 'SupplierController@destroy');
    Route::post('/ajax/supplier', 'SupplierController@store');
    Route::put('/ajax/supplier/{id}', 'SupplierController@update');

    Route::get('/order/create', 'OrderController@create')->name('order.create');
    Route::post('/ajax/order/store', 'OrderController@store')->name('order.store');
});

Route::auth();

Route::get('/home', 'HomeController@index');
