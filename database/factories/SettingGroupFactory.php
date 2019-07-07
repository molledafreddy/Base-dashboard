<?php

use Faker\Generator as Faker;

$factory->define(App\SettingGroup::class, function (Faker $faker) {
    return [
        'setting_tab_id' => rand(1,2),
        'name' => $faker->unique()->word,
        'icon' => 'ti-user',
    ];
});
