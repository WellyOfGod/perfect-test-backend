<?php

/** @var Factory $factory */

use App\Models\{Customer, Product, SaleSituation, Sale};
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Sale::class, function (Faker $faker) {
    $product = Product::all(['id', 'price'])->random();
    $quantity = rand(1, 500);
    $discount = rand(1, 100);

    $value = $product->price * $quantity;
    $total = $discount ? $value - ($value * ($discount / 100)) : $value;

    return [
        'sold_at'           => now()->subDays(rand(0, 365))->subHours(rand(0, 26)),
        'quantity'          => $quantity,
        'discount'          => $discount,
        'total'             => $total,
        'sale_situation_id' => SaleSituation::all(['id'])->random()->id,
        'product_id'        => $product->id,
        'customer_id'       => Customer::all(['id'])->random()->id
    ];
});
