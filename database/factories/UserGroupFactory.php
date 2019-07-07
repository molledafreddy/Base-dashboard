<?php

use Faker\Generator as Faker;

$factory->define(App\UserGroup::class, function (Faker $faker) {
    return [
        'parent_id' => $faker->numberBetween(1,5),
        'title' => $faker->word,
        'description' => $faker->sentence,
    ];
});
