<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

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


     public function dashboard() {

       $userId = Auth::user()->id;

       $apartments = Apartment::where('user_id', 3)->get();

       return view('page.dashboard', compact('apartments'));
     }

     public function createApartment() {

       $apartment = Apartment::all();
       return view('page.create-apartment', compact('$apartment'));
     }

     public function storeApartment(Request $request) {

       dd($request->all());
     }
}
