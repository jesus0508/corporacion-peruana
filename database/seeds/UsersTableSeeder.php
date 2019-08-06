<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombres' => 'Corporacion Peruana',
            'apellido_paterno' => 'Corporacion Peruana',
            'apellido_materno' => 'Corporacion Peruana',
            'telefono' => '2534035',
            'email' => 'corporacion@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
