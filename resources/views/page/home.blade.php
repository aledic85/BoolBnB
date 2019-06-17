@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="search">
        <img src="http://3.citynews-milanotoday.stgy.ovh/~media/original-hi/68320916180522/milano-panoramica-4.jpg">
        <div class="search-items">
            <input type="text" placeholder="Cerca">
            <i class="fas fa-search"></i>
        </div>
      </div>
    <div class="main">
        <div class="title">
            <h2>Appartamenti in Evidenza</h2>
        </div>


        <div class="featured_apartments">
          @foreach ($sponsoredApartments as $sponsoredApartment)
          <div class="apartament-container">
              <img src="{{$sponsoredApartment->img_path}}">
              <h3>{{$sponsoredApartment->title}}</h3>
              <p>{{$sponsoredApartment->description}}</p>
          </div>
        @endforeach
        </div>

    </div>
  </div>
@endsection
