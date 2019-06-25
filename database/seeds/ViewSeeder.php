<?php

use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\View::class, 20)->make()->each(function($view) {
          $apartment = App\Apartment::inRandomOrder()->first();
          $view->apartment()->associate($apartment);
          $view->save();
        });
    }
}
