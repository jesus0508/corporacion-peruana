<?php

use Illuminate\Database\Seeder;

class CuentasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cuentas')->insert([            
            'nro_cuenta' =>'SCOTIABANK 5442346',
            'fondo_actual' => 15000,  
            'banco_id'=> 1,
            'tipo'=> 'Soles',        
        ]); 
        DB::table('cuentas')->insert([            
            'nro_cuenta' =>'BCP 194-2462966-0-42',
            'fondo_actual' => 15000,  
            'banco_id'=> 2,  
            'tipo'=> 'Soles',       
        ]);  
        DB::table('cuentas')->insert([            
            'nro_cuenta' =>'BBVA 0011-0119-0100019881',
            'fondo_actual' => 15000,  
            'banco_id'=> 3,        
            'tipo'=> 'Soles', 
        ]);                
        DB::table('cuentas')->insert([            
            'nro_cuenta' =>'BBVA 0011-0119-0100024273',
            'fondo_actual' => 15000,  
            'banco_id'=> 3,        
            'tipo'=> 'Soles', 
        ]);
        DB::table('cuentas')->insert([            
            'nro_cuenta' =>'BBVA 0011-03397-0100012219',
            'fondo_actual' => 15000,  
            'banco_id'=> 3,        
            'tipo'=> 'Dolares', 
        ]);  
    }
}
