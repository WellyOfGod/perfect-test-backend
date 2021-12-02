<?php

use App\Models\{Customers, Product, Sale};
use Illuminate\Database\Seeder;
use Database\Seeders\{SaleSituationSeeder};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SaleSituationSeeder::class);

        factory(Customers::class, 20)->create();
        factory(Product::class, 20)->create();
        factory(Sale::class, 20)->create();
    }
}
