<?php

use App\Models\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function(Faker $faker){
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'birth' => $faker->date(),
        'uuid' => $faker->uuid
    ];
});
