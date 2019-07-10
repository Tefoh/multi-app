<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\Proposal::class, function (Faker $faker) {
    return [
        'offer'         => random_int(1000, 999999888),
        'deadline'      => random_int(1,120),
        'description'   => $faker->text,
    ];
});
