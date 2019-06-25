<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Apartment;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSender;
use Carbon\Carbon;

class GeneralController extends Controller
{
  public function index()
  {
    $now = new Carbon();
    $sponsoredApartments = Apartment::select('apartments.id','apartments.title','apartments.img_path', 'apartments.description')
                          ->join('apartment_sponsored', 'apartments.id', '=', 'apartment_sponsored.apartment_id')
                          ->join('sponsoreds', 'sponsoreds.id', '=', 'apartment_sponsored.sponsored_id')
                          ->where('end_sponsored', '>', $now)
                          ->active()->get();

// $sponsoredApartments = Apartment::all();
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
    $content = $request->content;

    $user = User::findORFail($id);

    $message = Message::make($request->all());
    $message->user()->associate($user)->save();


    Mail::to($user)->queue(new MailSender($name, $lastname, $email, $title, $content));

    return redirect('/');
  }

  public function searchApartments() {

    $lat = Apartment::select('latitude')->get();
    $long = Apartment::select('longitude')->get();

    return view('page.search-form', compact('lat', 'long'));
  }

  public function resultsApartments(Request $request) {

    $title = $request->title;
    $description = $request->description;
    $latitude = $request->latitude;
    $longitude = $request->longitude;
    $rooms = $request->rooms;
    $beds = $request->beds;
    $bathrooms = $request->bathrooms;
    $mq = $request->mq;
    $wi_fi = $request->wi_fi;
    $parking_space = $request->parking_space;
    $pool = $request->pool;
    $sauna = $request->sauna;

    $query = Apartment::query();

      if ($title != null) {
        $query = $query->where('title', 'LIKE','%'.$title.'%');
      }
      if ($description != null) {
        $query = $query->where('description', 'LIKE', '%'.$description.'%');
      }
      if ($latitude != null) {
        $query = $query->where('latitude', $latitude);
      }
      if ($longitude != null) {
        $query = $query->where('longitude', $longitude);
      }
      if ($rooms != null) {
        $query = $query->where('rooms', $rooms);
      }
      if ($beds != null) {
        $query = $query->where('beds', $beds);
      }
      if ($bathrooms != null) {
        $query = $query->where('bathrooms', $bathrooms);
      }
      if ($mq != null) {
        $query = $query->where('mq', $mq);
      }
      if ($wi_fi != null) {
        $query = $query->where('wi_fi', $wi_fi);
      }
      if ($parking_space != null) {
        $query = $query->where('parking_space', $parking_space);
      }
      if ($pool != null) {
        $query = $query->where('pool', $pool);
      }
      if ($sauna != null) {
        $query = $query->where('sauna', $sauna);
      }

      $apartments = $query->active()->get();

      return response()->json($apartments);
  }
}
