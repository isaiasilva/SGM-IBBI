<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Este diretório deve conter cada uma das definições de fábrica de modelo para
| sua aplicação. As fábricas fornecem uma maneira conveniente de gerar novas
| instâncias de modelo para testar / semear o banco de dados do aplicativo.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'branchname' => $faker->name . ' Church',
        'branchcode' => $faker->randomNumber(6),
        'country' => $faker->country,
        'email' => $faker->unique()->safeEmail,
        'state' => $faker->state,
        'city' => $faker->city,
        'address' => $faker->address,
        'currency' => $faker->randomElement(['$', '₦']),
        'isadmin' => $faker->boolean,
        'password' => bcrypt('admin'),//'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

// $factory->define(App\Customer::class, function (Faker $faker) {
//     return [
//         'email' => $faker->unique()->safeEmail,
//         'gfx_id' => $faker->unique()->randomNumber(6),
//         'firstname' => $faker->firstname,
//         'lastname' => $faker->lastname,
//         'phone' => $faker->unique()->phoneNumber,
//     ];
// });
//
// $factory->define(App\Service::class, function (Faker $faker) {
//     return [
//         'name' => $faker->unique()->word,
//     ];
// });
