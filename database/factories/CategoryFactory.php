<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $description = $faker->word;
    return [
        'name' => $description,
        'slug' => str_slug($description)
    ];
});
