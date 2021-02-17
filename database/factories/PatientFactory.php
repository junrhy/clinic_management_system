<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Patient::class, function (Faker $faker) {
	$gender = $faker->randomElement(['Male', 'Female']);

    return [
    	'client_id' => 1,
        'first_name' => $faker->firstName($gender),
        'last_name' => $faker->lastName,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => $gender,
        'email' => $faker->unique()->safeEmail,
        'contact_number' => $faker->phoneNumber,
        'user_id' => 1,
    ];
});