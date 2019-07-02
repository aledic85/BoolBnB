@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="homeP">
      <div class="title">
        <h2>Risultati della ricerca:</h2>
      </div>
      <div class="box-apartments flex-column flex-nowrap align-items-center">
        <div class="apartments-sponsored d-flex justify-content-start flex-wrap">
          @foreach ($apartments as $apartment)
            @if($apartment->end_sponsored)
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
          @endif
          @endforeach
        </div>
        <div class="apartments-unsponsored d-flex justify-content-center flex-wrap mt-5">
          @foreach ($apartments as $apartment)
            @if(!$apartment->end_sponsored)
            <div class="box-apartment rounded-bottom">
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
          @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
