<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSender;

class GeneralController extends Controller
{
  public function index()
  {

    $sponsoredApartments = Apartment::select('apartments.id','title','img_path', 'description')
                          ->join('apartment_sponsored', 'apartments.id', '=', 'apartment_sponsored.apartment_id')
                          ->active()
                          ->take(6)->get();

    return view('page.home', compact('sponsoredApartments'));
  }

  public function showApartment($id) {

    $apartment = Apartment::findORFail($id);

    return view('page.show-apart', compact('apartment'));
  }

  public function sendMail(Request $request, $id) {

    $name = $request->name;
    $lastname = $request->lastname;
    $email = $request->email;
    $title = $request->title;
    $content = $request->description;

    $user = User::findORFail($id);

    Mail::to($user)->queue(new MailSender($name, $lastname, $email, $title, $content));

    return redirect('/');
  }
}
