<?php

use Illuminate\Support\Facades\Route;


//Route::match([Request::METHOD_GET, Request::METHOD_POST], '/', 'DashboardController')->name('dashboard');

//Route::resources([
//    'product' => 'ProductController',
//    'client'  => 'ClientController',
//    'sale'    => 'SaleController',
//], ['except' => ['index', 'show']]);

Route::resource('product', 'ProductController');
