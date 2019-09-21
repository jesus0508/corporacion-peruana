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
            'email' => 'corporacion@gmail.com',
            'password' => bcrypt('123456'),
            'trabajador_id' => '1'
        ]);

        DB::table('users')->insert([
            'email' => 'nati@gmail.com',
            'password' => bcrypt('123456'),
            'trabajador_id' => '2'
        ]);


    }
}
