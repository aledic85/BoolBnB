<?php

use Illuminate\Database\Seeder;

class SponsoredSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Sponsored::class, 4)->create()->each(function($sponsored) {
      $apartment = App\Apartment::inRandomOrder()->take(5)->get();
      $sponsored->apartments()->attach($apartment);
    });
    }
}
