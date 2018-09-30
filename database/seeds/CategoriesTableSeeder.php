<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $cat_array = [
        'Off Topic',
        'Web Development',
        'Life Hacks',
        'Retro Games',
        'Sega Megadrive',
        'SEGA',
        'SONY',
        'Nintendo',
        'Xbox',
        '8-bit',
        'Restoration and Maintenance',
        'Polls and Lists'
      ];
      $faker = Faker::create();
      foreach ($cat_array as $key => $cat) {
        $slug = Str::slug($cat);
        DB::table('categories')->insert([
          'title' => $cat,
          'slug' => $slug,
          'description' => $faker->text(100)
        ]);
      }
    }
}
