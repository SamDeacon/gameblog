<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Category::class, function (Faker $faker) {

  $title = $faker->unique()->words($nb = 2, $asText = true);
  $slug = Str::slug($title);
    return [
        'title' => $title,
        'slug' => $slug,
        'description' => $faker->text(100),
    ];
});
