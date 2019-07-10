<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'user_id'           => random_int(1, \App\User::count()),
        'title'             => $faker->sentence,
        'body'              => $faker->text,
        'is_open'           => random_int(0,1),
        'budget'            => random_int(1000, 999999999),
    ];
});
