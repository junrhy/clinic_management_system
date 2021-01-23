<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Doctor::class, function (Faker $faker) {
    $gender = $faker->randomElement(['Male', 'Female']);
    
    return [
        'client_id' => 1,
        'first_name' => $faker->firstName($gender),
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'contact_number' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});
