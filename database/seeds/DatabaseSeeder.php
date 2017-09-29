<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //$this->call(User::class);
      $user = factory(App\User::class)->make()->toArray();
      $user['password'] = bcrypt('secret');
      $user_id = App\User::insert($user);

      $userProfile = factory(App\Models\UserProfile::class)->make()->toArray();

      $user = App\User::find($user_id);
      $user->user_profile()->create($userProfile);

    }
}
