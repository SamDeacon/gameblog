<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Generate 10 basic users
      $i = 1;
      while ($i <= 20) {
        DB::table('users')->insert([
            'name' => 'basicuser'.$i,
            'email' => 'basicuser'.$i.'@gmail.com',
            'usertype' => 'user',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s');
        ]);
        $i++;
      }


      //Add 1 editor
      DB::table('users')->insert([
          'name' => 'editor',
          'email' => 'editor@gmail.com',
          'usertype' => 'editor',
          'password' => bcrypt('password'),
      ]);

      // Add 1 Superadmin
      DB::table('users')->insert([
          'name' => 'superadmin',
          'email' => 'superadmin@app.com',
          'usertype' => 'admin',
          'password' => bcrypt('password'),
      ]);
    }
}
