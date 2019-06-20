<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

  public function resultsApartments() {

    $title = Input::get('title');
    $description = Input::get('description');
    $latitude = Input::get('latitude');
    $longitude = Input::get('longitude');
    $rooms = Input::get('rooms');
    $beds = Input::get('beds');
    $bathrooms = Input::get('bathrooms');
    $mq = Input::get('mq');
    $wi_fi = Input::get('wi_fi');
    $parking_space = Input::get('parking_space');
    $pool = Input::get('pool');
    $sauna = Input::get('sauna');

    $query = Apartment::query();

      if ($title != null) {
        $query = $query->where('title', 'LIKE','%'.$title.'%');
      }
      if ($description != null) {
        $query = $query->where('description', 'LIKE', '%'.$description.'%');
      }
      if ($latitude) {
        $query = $query->where('latitude', $latitude);
      }
      if ($longitude) {
        $query = $query->where('longitude', $longitude);
      }
      if ($rooms) {
        $query = $query->where('rooms', $rooms);
      }
      if ($beds) {
        $query = $query->where('beds', $beds);
      }
      if ($bathrooms) {
        $query = $query->where('bathrooms', $bathrooms);
      }
      if ($mq) {
        $query = $query->where('mq', $mq);
      }
      if ($wi_fi) {
        $query = $query->where('wi_fi', $wi_fi);
      }
      if ($parking_space) {
        $query = $query->where('parking_space', $parking_space);
      }
      if ($pool) {
        $query = $query->where('pool', $pool);
      }
      if ($sauna) {
        $query = $query->where('sauna', $sauna);
      }

      $apartments = $query->active()->get();

      return response()->json($apartments);


  }
}
