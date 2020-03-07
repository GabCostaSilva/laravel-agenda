<?php

use App\Models\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function(Faker $faker){
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->email,
        'birth' => $faker->date()
    ];
});
