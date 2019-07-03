@extends('layout.home-layout')

@section('content')
<div class="wrapper">
  <div class="dashB">
    <div class="boxAddNew">
      <h2>Benvenuto nella tua dashboard {{ Auth::user() -> name }}</h2>
      <div class="boxButtons">
        <a href="{{ route('new.apart') }}"><button type="submit" name="create">AGGIUNGI APPARTAMENTO</button></a>
        <a href="{{ route('received.messages') }}"><button type="submit" name="create">VISUALIZZA MESSAGGI RICEVUTI</button></a>
      </div>
    </div>
    <div class="box-apartments">
      @foreach ($apartments as $apartment)
        <a href="{{route('apart.stats', $apartment->id)}}">
          <div class="box-apartment rounded-bottom">
            <div class="box-image">
              <img src="{{ asset($apartment->path) }}">
              <form class="del" action="{{route('delete.apart', $apartment-> id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" name="delete"><i class="far fa-trash-alt popup">
                  <span class="popuptext">elimina appartamento</span>
                </i></button>
              </form>
            </div>
            <div class="box-data">
              <h3>{{ $apartment -> title }}</h3>
              <p class="descr">{{ $apartment -> description }}</p>
              <p class="addr">{{ $apartment -> address }}</p>
              <ul>
                <li>Numero stanze: {{ $apartment -> rooms }}</li>
                <li>Numero letti: {{ $apartment -> beds }}</li>
                <li>Numero bagni: {{ $apartment -> bathrooms }}</li>
                <li>Metri quadrati: {{ $apartment -> mq }}</li>
              </ul>
              <div class="char-wrapper">
                <span>Wi-Fi: </span><span>{{$apartment->wi_fi}}</span>
                <span>Parking space: </span><span>{{$apartment->parking_space}}</span>
                <span>Pool: </span><span>{{$apartment->pool}}</span>
                <span>Sauna: </span><span>{{$apartment->sauna}}</span>
                <span class="activeApp">Annuncio attivo: </span><span class="textactive">{{$apartment->active}}</span>
              </div>
              <a class="ed" href="{{route('edit.apart', $apartment->id)}}">
                <button type="submit" name="edit">
                  <i class="fas fa-edit popup">
                    <span class="popuptext">modifica appartamento</span>
                  </i>
                </button>
              </a>
                @if($apartment->sponsoreds()->where('end_sponsored', '>', $now)->get()->isNotEmpty())
                  <a class="spns" href=""><button type="submit" name="edit">ANNUNCIO SPONSORIZZATO</button></a>
                @else
                  <a class="spns" href="{{route('spons.apart', $apartment->id)}}"><button type="submit" name="edit">SPONSORIZZA ANNUNCIO</button></a>
                @endif
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</div>

<script type="text/javascript">

  var wrap = $('.char-wrapper > span');

  wrap.each(function() {

    if ($(this).text() == '0') {

      $(this).text('no');
    } else if ($(this).text() == '1') {

      $(this).text('sì');
    }
  });

  $(document).ready(function(){
    setTimeout(function(){
       $("div.alert").fadeOut();
    }, 3000 );

  });

</script>

@stop
