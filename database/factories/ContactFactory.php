<?php

use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function(Faker $faker){
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->email,
        'birth' => $faker->date()
    ];
});
