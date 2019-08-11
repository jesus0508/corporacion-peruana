<?php

use Illuminate\Database\Seeder;

class ProveedoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        DB::table('proveedores')->insert([
            'razon_social'=>'PERUANA DE COMBUSTIBLES S.A - PECSA',
            'ruc' => '20259033072',
            'email' => 'tbartra@pecsa.com.pe',
        ]);    	
        DB::table('proveedores')->insert([
            'razon_social'=>'CORPORACION PRIMAX S.A.',
            'ruc' => '20554545743',
            'email' => 'contactenos@primax.com.pe',
        ]);

        DB::table('proveedores')->insert([
            'razon_social'=>'PURE BIOFUELS DEL PERU S.A.C - PBF',
            'ruc' => '20513251506',
            'email' => 'comunicaciones.peru@valero.com',
        ]);
    }
}
