<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Article::class, function (Faker $faker) {


    $ranlength = $faker->numberBetween($min = 6, $max = 24);
    $title = ucwords($faker->unique()->text($ranlength));
    $trimmed = rtrim($title, " \t.");
    $slug = Str::slug($title);
    return [
      'title' => $trimmed,
      'slug' => $slug,
      'body' => $faker->text(250),
      'category_id' => $faker->numberBetween($min = 1, $max = 12),
    ];
});
