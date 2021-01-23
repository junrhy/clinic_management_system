<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Service::class, function (Faker $faker) {
    
    return [
        'client_id' => 1,
        'name' => $faker->word,
    ];
});
