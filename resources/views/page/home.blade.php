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
    <div class="homeP">
      <div class="title">
        <h2>Appartamenti in Evidenza</h2>
      </div>
      <div class="box-apartments">
        @foreach ($sponsoredApartments as $sponsoredApartment)
          <div class="box-apartment rounded-bottom">
            <div class="box-image">
              <img src="{{ URL::to('/storage') }}/images/{{ $sponsoredApartment->img_path }}">
              <form class="del" action="{{route('delete.apart', $sponsoredApartment-> id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" name="delete"><i class="far fa-trash-alt popup">
                  <span class="popuptext">elimina appartamento</span>
                </i></button>
              </form>
            </div>
            <div class="box-data">
              <h3>{{ $sponsoredApartment -> title }}</h3>
              <p class="descr">{{ $sponsoredApartment -> description }}</p>
              <p class="addr">{{ $sponsoredApartment -> address }}</p>
              <ul>
                <li>Numero stanze: {{ $sponsoredApartment -> rooms }}</li>
                <li>Numero letti: {{ $sponsoredApartment -> beds }}</li>
                <li>Numero bagni: {{ $sponsoredApartment -> bathrooms }}</li>
                <li>Metri quadrati: {{ $sponsoredApartment -> mq }}</li>
              </ul>
              <div class="char-wrapper">
                <span>Wi-Fi: </span><span>{{$sponsoredApartment->wi_fi}} - </span>
                <span>Parking space: </span><span>{{$sponsoredApartment->parking_space}} - </span>
                <span>Pool: </span><span>{{$sponsoredApartment->pool}} - </span>
                <span>Sauna: </span><span>{{$sponsoredApartment->sauna}}&nbsp;&nbsp;</span>
                <span class="activeApp">Annuncio attivo: </span><span class="textactive">{{$sponsoredApartment->active}}</span>
              </div>
              <a class="ed" href="{{route('edit.apart', $sponsoredApartment->id)}}"><button type="submit" name="edit"><i class="fas fa-edit popup">
                <span class="popuptext">modifica appartamento</span>
              </i></button></a>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </div>
@endsection
