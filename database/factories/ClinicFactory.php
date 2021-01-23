<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Clinic::class, function (Faker $faker) {
    
    return [
        'client_id' => 1,
        'name' => $faker->company,
        'address' => $faker->address,
        'contact_number' => $faker->phoneNumber,
    ];
});
