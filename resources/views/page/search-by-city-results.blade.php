@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="homeP">
      <div class="title">
        <h2>Risultati della ricerca:</h2>
      </div>
      <div class="box-apartments">
        @foreach ($apartments as $apartment)
          @if($apartment->sponsoreds()->where('end_sponsored', '>', $now)->get()->isNotEmpty())
            <div class="box-apartment rounded-bottom sponsored">
              <a class="dets" href="{{ route('show.apart', $apartment->id) }}">
                <div class="box-image">
                  <img src="{{ asset($apartment->path) }}">
                </div>
                <div class="box-data">
                  <h3>{{ $apartment ->title }}</h3>
                  <p class="descr">{{ $apartment->description }}</p>
                  <p class="addr">{{ $apartment->address }}</p>
                </div>
              </a>
            </div>
          @else
            <div class="box-apartment rounded-bottom">
              <a class="dets" href="{{ route('show.apart', $apartment->id) }}">
                <div class="box-image">
                  <img src="{{ asset($apartment->path) }}">
                </div>
                <div class="box-data">
                  <h3>{{ $apartment->title }}</h3>
                  <p class="descr">{{ $apartment->description }}</p>
                  <p class="addr">{{ $apartment->address }}</p>
                </div>
              </a>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>
@endsection
