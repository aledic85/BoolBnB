@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="search">
        <img src="http://3.citynews-milanotoday.stgy.ovh/~media/original-hi/68320916180522/milano-panoramica-4.jpg">
        <div class="search-items">
            <input type="text" placeholder="Cerca per città">
            <i class="fas fa-search"></i>
        </div>
      </div>
    <div class="main">
        <div class="title">
            <h2>Appartamenti in Evidenza</h2>
        </div>

        <div class="featured_apartments mt-50">
          @foreach ($sponsoredApartments as $sponsoredApartment)
          <div class="apartament-container">
              <img src="{{ URL::to('/storage') }}/images/{{ $sponsoredApartment->img_path }}">
              <h6>{{$sponsoredApartment->title}}</h6>
              <p>{{$sponsoredApartment->description}}</p>
              <a href="{{route('show.apart', $sponsoredApartment->id)}}"><button type="button" name="button">DETTAGLI APPARTAMENTO</button></a>
          </div>
        @endforeach
        </div>

    </div>
  </div>
@endsection
