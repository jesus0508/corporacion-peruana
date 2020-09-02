<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use CorporacionPeru\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'nombre' => 'Ventas',
        'descripcion' => 'Rol de vendedor'
    ];
});
