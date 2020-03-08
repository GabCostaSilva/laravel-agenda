<?php

use App\Models\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function(Faker $faker){
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->email,
        'birth' => $faker->date(),
        'street' => $faker->streetName,
        'state' => $faker->state,
        'number' => $faker->randomNumber(),
        'post_code' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
        'uuid' => $faker->uuid
    ];
});
