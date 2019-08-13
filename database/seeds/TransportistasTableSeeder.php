<?php

use Illuminate\Database\Seeder;

class TransportistasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transportistas')->insert([
            'nombre_transportista'=>'JORGE CONTRERAS',
            'ruc' => '20265893072',
            'celular_transportista' => '999456987',
        ]);

        DB::table('transportistas')->insert([
            'nombre_transportista'=>'LUIS ALBURQUEQUE',
            'ruc' => '20265899856',
            'celular_transportista' => '999465887',
        ]); 
    }
}
