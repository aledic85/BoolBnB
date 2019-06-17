<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;

class GeneralController extends Controller
{
  public function index()
  {

    $sponsoredApartments = Apartment::select('title','img_path', 'description')
                          ->join('apartment_sponsored', 'apartments.id', '=', 'apartment_sponsored.apartment_id')
                          ->active()
                          ->take(6)->get();

    return view('page.home', compact('sponsoredApartments'));
  }
}
