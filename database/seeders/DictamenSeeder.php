<?php

namespace Database\Seeders;

use App\Models\Dictamen;
use App\Models\Operador;
use App\Models\Tracto;
use App\Models\Viaje;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DictamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_MX');

        // Retorna registros existentes deOperador, Tracto, and Viaje IDs
        $operadorIds = Operador::pluck('_id')->toArray();
        $tractoIds = Tracto::pluck('_id')->toArray();
        $viajeIds = Viaje::pluck('_id')->toArray();

        if (empty($operadorIds) || empty($tractoIds) || empty($viajeIds)) {
            echo "Please seed Operadores, Tractos, and Viajes first.\n";
            return;
        }

        for ($i = 0; $i < 50; $i++) {
            Dictamen::create([
                'viaje_id' => $faker->randomElement($viajeIds),
                'operador_id' => $faker->randomElement($operadorIds),
                'tracto_id' => $faker->randomElement($tractoIds),
                'apto' => $faker->boolean(),
                'bmp' => $faker->numberBetween(0, 100),
                'fecha' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
