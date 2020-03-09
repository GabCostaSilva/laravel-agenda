<?php


use App\Models\Contact;
use App\Models\Phone;
use Faker\Generator as Faker;

$factory->define(Phone::class, function(Faker $faker){
    $contact = Contact::firstOrCreate(['id' => 1], factory(Contact::class)->make()->toArray());
    return [
        'area_code' => $faker->randomNumber(2),
        'number' => $faker->randomNumber(9),
        'contact_id' => $contact->id,
        'primary' => true,
    ];
});
