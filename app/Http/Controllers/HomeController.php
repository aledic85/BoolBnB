<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index()
    {



      $sponsoredApartments = Apartment::select('title','img_path')->join('apartment_sponsored', 'apartments.id', '=', 'apartment_sponsored.apartment_id')->where('apartments.active', '=', '1')->get();

      return view('page.home', compact('sponsoredApartments'));

    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

}
