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
    Route::get('/item/stock', 'ItemController@stock')->name('item.stock');
    Route::get('/ajax/item/stock', 'ItemController@getStock');

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

    Route::get('/order', 'OrderController@index')->name('order.index');
    Route::get('/ajax/order', 'OrderController@fillDatatable')->name('order.data');
    Route::get('/order/create', 'OrderController@create')->name('order.create');
    Route::post('/ajax/order/store', 'OrderController@store')->name('order.store');
    Route::get('/ajax/order/{id}/order_detail', 'OrderController@getOrderDetail');
    Route::get('/order/{id}/edit', 'OrderController@edit');
    Route::put('/ajax/order/{id}', 'OrderController@update');
    Route::delete('/ajax/order/{id}', 'OrderController@destroy');

    Route::get('/purchase', 'PurchaseReceiptController@index')->name('purchase.index');
    Route::get('/ajax/purchase', 'PurchaseReceiptController@fillDatatable')->name('purchase.data');
    Route::get('/purchase/create', 'PurchaseReceiptController@create')->name('purchase.create');
    Route::post('/ajax/purchase/store', 'PurchaseReceiptController@store')->name('purchase.store');
    Route::get('/ajax/purchase/{id}/purchase_detail', 'PurchaseReceiptController@getPurchaseReceiptDetail');
    Route::get('/purchase/{id}/edit', 'PurchaseReceiptController@edit');
    Route::put('/ajax/purchase/{id}', 'PurchaseReceiptController@update');
    Route::delete('/ajax/purchase/{id}', 'PurchaseReceiptController@destroy');

    Route::get('/cash_flow', 'CashFlowController@index')->name('cash_flow.index');
    Route::get('/ajax/cash_flow', 'CashFlowController@fillCashFlow');
    Route::get('/cash_flow/create', 'CashFlowController@create')->name('cash_flow.create');
    Route::post('/cash_flow', 'CashFlowController@store')->name('cash_flow.store');
});

Route::auth();

Route::get('/home', 'HomeController@index');
