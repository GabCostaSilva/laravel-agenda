<?php


use App\Models\Contact;
use App\Models\Phone;
use Faker\Generator as Faker;

$factory->define(Phone::class, function(Faker $faker){
    $contact = factory(Contact::class)->create();

    return [
        'area_code' => $faker->randomNumber(2),
        'number' => $faker->randomNumber(9),
        'owner' => $contact->id,
        'primary' => true,
    ];
});
