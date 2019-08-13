<?php

use Illuminate\Database\Seeder;

class VehiculosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('vehiculos')->insert([
            'placa'=>'QEW-978',
            'capacidad' => '1500',
            'detalle_compartimiento' => 'Cuenta con 2 compartimientos, el primero con 600
            galones de capadidad y el segundo con 900 galones',
            'transportista_id' => '1',
        ]);

      DB::table('vehiculos')->insert([
            'placa'=>'RTW-978',
            'capacidad' => '3000',
            'detalle_compartimiento' => 'No cuenta con compartimientos..',
            'transportista_id' => '2',
        ]);
    }
}
