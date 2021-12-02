<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SaleSituation;

class SaleSituationSeeder extends Seeder
{

    public function run(): void
    {
        $data = collect([
            [
                'name' => 'Aprovada'
            ],
            [
                'name' => 'Pendente'
            ],
            [
                'name' => 'Cancelada'
            ],
            [
                'name' => 'Estornada'
            ]
        ]);

        $data->each(fn ($item) => SaleSituation::create($item));
    }
}
