<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Member::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'branch_id' => $faker->randomElement((function(){
          return App\User::pluck('id')->toArray();
        })()),
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'phone' => $faker->unique()->phoneNumber,
        'title' => $faker->randomElement(['Mr', 'Mrs', 'Miss','Dr (Mrs)', 'Dr', 'Prof', 'Chief', 'Chief (Mrs)', 'Engr', 'Surveyor', 'HRH','Elder','Oba','Olori']),
        'dob' => $faker->dateTimeBetween('1970-01-01', '2006-12-31')->format('d-m-Y'),
        'occupation' => $faker->randomElement(["Doctor","Engineer","Surveyor","Business Person","Lecturer","Professor","Pharmacist",	"Trader","Civil Servant","Retired",]),
        'position' => $faker->randomElement(['worker','senior pastor','pastor', 'elder','usher','member', 'chorister','technician','instrumentalist', 'deacon','deaconess','evangelist','minister','protocol']),
        'address' => $faker->address,
        //'address2' => $faker->address,
        'postal' => $faker->randomNumber(6),
        'state' => $faker->state,
        'city' => $faker->city,
        'address' => $faker->address,
        'country' => $faker->country,
        'sex' => $faker->randomElement(['masculino', 'feminino']),
        'marital_status' => $faker->randomElement(['casado', 'solteiro','viuvo','divorciado','separado']),
        'member_since' => $faker->dateTimeBetween('01-01-2008', '31-12-2025')->format('d-m-Y'),
        'wedding_anniversary' => $faker->dateTimeBetween('01-01-2018', '31-12-2025')->format('d-m-Y'),
        'photo' => 'profile.png',
        'member_status' => $faker->randomElement(['membro', 'visitante','congregando','inativo','obito']),
        'cpf' => $faker->cpf,
    ];
});
