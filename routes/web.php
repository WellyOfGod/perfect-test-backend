<?php

use Illuminate\Support\Facades\Route;

Route::resources([
    'product' => 'ProductController',
    'sale' => 'SaleController',
    'customer' => 'CustomerController'
], ['except' => ['index', 'show']]);
