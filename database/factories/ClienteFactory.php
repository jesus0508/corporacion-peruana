<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use CorporacionPeru\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'ruc' => $faker->numerify('###########'),
        'razon_social' => $faker->company,
        'cargo'=> $faker->optional(0.5)->jobTitle,
        'representante'=> $faker->optional(0.5)->name,
        'dni'=> $faker->optional(0.5)->dni,
        'correo_cliente'=> $faker->optional(0.5)->safeEmail,
        'actividad_economica'=> $faker->optional(0.5)->name,
        'precio_galon'=> $faker->numberBetween($min = 1, $max = 999),
        'linea_credito'=> $faker->numberBetween($min = 1, $max = 99999),
        'distrito'=> $faker->city,
        'telefono'=> $faker->numerify('#######'),
        'direccion'=> $faker->address,
        'forma_pago'=> $faker->randomElement(['quincenal', 'mensual']),
        'persona_comision'=> $faker->name,
        'correo_representante'=> $faker->email
    ];
});
