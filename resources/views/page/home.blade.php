@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="search">
      <div class="trisImg">
        <img src="{{ asset('img/stagione_estate_038.jpg') }}">
        <div class="headertitle">
          <img src="{{ asset('img/b&b_lusso.jpeg') }}">
          <img src="{{ asset('img/b&b_lusso3.jpeg') }}">
          <img src="{{ asset('img/b&b_lusso2.jpeg') }}">
          <h1>PRONTO<br> PER<br> UNA<br> NUOVA<br> ESPERIENZA<br>?</h1>
        </div>
      </div>
      <div class="search-items">
        <div class="box-search-items">
          <input type="text" placeholder="Inserisci una città, un'indirizzo...">
          <a href="#" class="goSearch">VAI</a>
        </div>
        <a class="advSearch" href="{{ route('search.apart') }}">Ricerca avanzata</a>
      </div>
    </div>
    <div class="homeP">
      <div class="title">
        <h2>Appartamenti in Evidenza</h2>
      </div>
      <div class="box-apartments">
        @foreach ($sponsoredApartments as $sponsoredApartment)
          <div class="box-apartment rounded-bottom">
            <a class="dets" href="{{ route('show.apart', $sponsoredApartment->id) }}">
              <div class="box-image">
                <img src="{{ URL::to('/storage') }}/images/{{ $sponsoredApartment->img_path }}">
              </div>
              <div class="box-data">
                <h3>{{ $sponsoredApartment -> title }}</h3>
                <p class="descr">{{ $sponsoredApartment -> description }}</p>
                <p class="addr">{{ $sponsoredApartment -> address }}</p>
              </div>
            </a>
          </div>
        @endforeach
      </div>

    </div>
  </div>
@endsection
