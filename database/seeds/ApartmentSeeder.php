<?php

use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      factory(App\Apartment::class, 20)->make()->each(function($apartment) {
          $user = App\User::inRandomOrder()->first();
          $apartment->user()->associate($user);
          $apartment->save();
        });
    }
}
