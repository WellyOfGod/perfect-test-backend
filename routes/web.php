<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::match([Request::METHOD_GET, Request::METHOD_POST], '/', 'DashboardController')->name('dashboard');

Route::resources([
    'product' => 'ProductController',
    'sale' => 'SaleController',
    'customer' => 'CustomerController'
], ['except' => ['index', 'show']]);

Route::get('teste', function(){
    dd(\App\Models\Sale::find(1)->customer);
});

