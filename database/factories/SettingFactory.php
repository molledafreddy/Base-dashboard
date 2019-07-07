<?php

use Faker\Generator as Faker;

$factory->define(App\Setting::class, function (Faker $faker) {
    return [
        'setting_group_id' => function(){
            return firstOrFactory(SettingGroup::class);
        },
        'param' => $faker->word,
        'key' => $faker->word,
        'value' => $faker->word,
        'type' => $faker->randomElement(['text', 'longText', 'number', 'boolean', 'html']),
    ];
});
