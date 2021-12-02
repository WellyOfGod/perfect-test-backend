<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customers;
use Faker\Generator as Faker;

$factory->define(Customers::class, function (Faker $faker) {
    return [
        'name'  => $faker->name,
        'email' => $faker->unique()->safeEmail(),
        'cpf'   => rand(00000000, 99999999)
    ];
});
