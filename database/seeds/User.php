<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'first_name' => str_random(10),
          'last_name' => str_random(10),
          'email' => 'wilsontay90@gmail.com',
          'password' => bcrypt('secret'),
          'ic_number' => str_random(10),
          'passport' => str_random(10),
          'nationality' => str_random(10),
          'emergency_contact_name' => str_random(10),
          'emergency_contact_relationship' => str_random(10),
          'emergency_contact_no' => str_random(10),
          'SnP' => str_random(10),
          'street' => str_random(10),
          'city' => str_random(10),
          'state' => str_random(10),
          'country' => str_random(10),
          'zip' => str_random(10),
          'race' => str_random(10),
          'contact_no' => str_random(10),
          'status' => 1,

      ]);
    }
}
