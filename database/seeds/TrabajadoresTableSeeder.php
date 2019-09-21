<?php

use Illuminate\Database\Seeder;

class TrabajadoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('trabajadores')->insert([
            'dni' => '08372118',
            'nombres' => 'Corporacion Peruana',
            'apellido_paterno' => 'Corporacion Peruana',
            'apellido_materno' => 'Corporacion Peruana',
            'telefono' => '3872937'
        ]);

        DB::table('trabajadores')->insert([
            'dni' => '08372182',
            'nombres' => 'Nati',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'telefono' => '980563'
        ]);
    }
}
