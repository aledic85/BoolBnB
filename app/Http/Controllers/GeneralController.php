<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Apartment;
use App\Message;
use App\User;
use App\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSender;
use Carbon\Carbon;

class GeneralController extends Controller
{
  public function index()
  {
    $lat = Apartment::select('latitude')->get();
    $long = Apartment::select('longitude')->get();
    $ids = Apartment::select('id')->get();
    $now = new Carbon();
    $sponsoredApartments = Apartment::select('apartments.id','apartments.title','apartments.img_path', 'apartments.description', 'apartments.address')
                          ->join('apartment_sponsored', 'apartments.id', '=', 'apartment_sponsored.apartment_id')
                          ->join('sponsoreds', 'sponsoreds.id', '=', 'apartment_sponsored.sponsored_id')
                          ->where('end_sponsored', '>', $now)
                          ->active()->get();

// $sponsoredApartments = Apartment::all();
    return view('page.home', compact('sponsoredApartments', 'lat', 'long', 'ids'));
  }

  public function showApartment($id) {

    $apartment = Apartment::findORFail($id);

    $allIpsCollection = View::select('ip')->where('apartment_id', $id)->get()->all();
    $allIps = [];

    foreach ($allIpsCollection as $singleIp) {

      $allIps[] = $singleIp['ip'];
    }
    $clientIP = \Request::ip();

    if (in_array($clientIP, $allIps) == false) {

      $newView = View::make();
      $newView->ip = $clientIP;
      $newView->apartment_id = $id;
      $newView->save();
    }


    return view('page.show-apart', compact('apartment'));
  }

  public function sendMail(Request $request, $userId, $apartId) {

    $name = $request->name;
    $lastname = $request->lastname;
    $email = $request->email;
    $title = $request->title;
    $content = $request->content;

    $user = User::findORFail($userId);
    $apartment = Apartment::findORFail($apartId);

    $message = Message::make($request->all());
    $message->user()->associate($user);
    $message->apartment()->associate($apartment)->save();



    Mail::to($user)->queue(new MailSender($name, $lastname, $email, $title, $content));

    return redirect('/');
  }

  public function searchApartments() {

    $lat = Apartment::select('latitude')->get();
    $long = Apartment::select('longitude')->get();
    $ids = Apartment::select('id')->get();

    return view('page.search-form', compact('lat', 'long', 'ids'));
  }

  public function resultsApartments(Request $request) {

    $title = $request->title;
    $description = $request->description;
    $ids = $request->ids;
    $rooms = $request->rooms;
    $beds = $request->beds;
    $bathrooms = $request->bathrooms;
    $mq = $request->mq;
    $wi_fi = $request->wi_fi;
    $parking_space = $request->parking_space;
    $pool = $request->pool;
    $sauna = $request->sauna;

    $query = Apartment::query();

    if ($ids != null) {

      $query = $query->whereIn('id', $ids);
    }
    if ($title != null) {
      $query = $query->where('title', 'LIKE','%'.$title.'%');
    }
    if ($description != null) {
      $query = $query->where('description', 'LIKE', '%'.$description.'%');
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

  public function searchByCityResults(Request $request) {

    $ids = $request->ids;

    $query = Apartment::query();

    if ($ids) {

      $query = $query->whereIn('id', $ids);
    }

    $apartments = $query->active()->get();

    return view('page.search-by-city-results', compact('apartments'));
  }
}
