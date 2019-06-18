<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApartmentRequest;

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

       $apartments = Apartment::where('user_id', $userId)->get();

       return view('page.dashboard', compact('apartments'));
     }

     public function createApartment() {

       return view('page.create-apartment');
     }

     public function storeApartment(ApartmentRequest $request) {

       $validatedData = $request->validated();

       $image = $request->file('img_path');
       $ext = $image->getClientOriginalExtension();
       $filename = $image->getFilename().'.'.$ext;
       $image->storeAs('public/images',$filename);

       $apartment = Apartment::make($validatedData);
       $apartment->img_path = $image->getFilename().'.'.$ext;
       $user = Auth::user();
       $apartment->user()->associate($user)->save();

       return redirect('dashboard')->with('success','Appartamento aggiunto con successo!');
     }

     public function editApartment($id) {

       $apartment = Apartment::findORFail($id);

       return view('page.edit-apartment', compact('apartment'));
     }

     public function updateApartment(ApartmentRequest $request, $id) {

       $validatedData = $request->validated();

       $image = $request->file('img_path');
       $ext = $image->getClientOriginalExtension();
       $filename = $image->getFilename().'.'.$ext;
       $image->storeAs('public/images',$filename);

       $apartment = Apartment::findORFail($id);
       $apartment->img_path = $image->getFilename().'.'.$ext;
       $apartment->update($validatedData);

       return redirect('dashboard')->with('success','Appartamento modificato con successo!');
     }

     public function deleteApartment($id) {

       $apartment = Apartment::findORFail($id)->delete();

       return redirect('dashboard')->with('success','Appartamento eliminato con successo!');
     }
}
