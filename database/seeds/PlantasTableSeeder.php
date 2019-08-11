<?php

use Illuminate\Database\Seeder;

class PlantasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('plantas')->insert([
            'planta'=>'PAMPILLA',
            'direccion_planta' => 'Av. la pampilla 322',
            'celular_planta' => '987456132',
            'proveedor_id' => '1',
        ]);

        DB::table('plantas')->insert([
            'planta'=>'CALLAO',
            'direccion_planta' => 'Av. Callao 355',
            'celular_planta' => '987451232',
            'proveedor_id' => '2',
        ]);

        DB::table('plantas')->insert([
            'planta'=>'CONCHAN',
            'direccion_planta' => 'Av. Conchan 355',
            'celular_planta' => '986586132',
            'proveedor_id' => '2',
        ]);

        DB::table('plantas')->insert([
            'planta'=>'PBF',
            'direccion_planta' => 'Av. Pebefe 355',
            'celular_planta' => '987456555',
            'proveedor_id' => '3',
        ]);                        
    }
}
