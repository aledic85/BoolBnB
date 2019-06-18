@extends('layout.home-layout')

@section('content')
<div class="wrapper">
  <div class="container dashB">
    <div class="boxAddNew">
      <h2>Benvenuto nella tua dashboard {{ Auth::user() -> name }}</h2>
      <form class="" action="{{ route('new.apart') }}" method="get">
        @csrf
        @method('POST')
        <button type="submit" name="create">AGGIUNGI APPARTAMENTO</button>
      </form>
    </div>
    <div class="box-apartments">
      @foreach ($apartments as $apartment)
        <div class="box-apartment rounded-bottom">
          <img src="{{ URL::to('/storage') }}/images/{{ $apartment->img_path }}">
          <div class="infoAp p-2">
            <h3>{{ $apartment -> title }}</h3>
            <p>{{ $apartment -> description }}</p>
            <p>Via Giuseppe Garibaldi, 11A {{ $apartment -> latitude }} {{ $apartment -> longitude }}</p>
            <ul>
              <li>Numero stanze: {{ $apartment -> rooms }}</li>
              <li>Numero letti: {{ $apartment -> beds }}</li>
              <li>Numero bagni: {{ $apartment -> bathrooms }}</li>
              <li>Metri quadrati: {{ $apartment -> mq }}</li>
            </ul>
            <div class="char-wrapper">
              <span>Wi-Fi: {{$apartment->wi_fi}}, </span>
              <span>Parking space: {{$apartment->parking_space}}, </span>
              <span>Pool: {{$apartment->pool}}, </span>
              <span>Sauna: {{$apartment->sauna}}, </span>
              <span>Annuncio attivo: {{$apartment->active}}</span>
            </div>
            <a href="{{route('edit.apart', $apartment->id)}}"><button type="submit" name="edit">MODIFICA</button></a>
            <form class="del" action="{{route('delete.apart', $apartment-> id)}}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" name="delete">ELIMINA</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<script type="text/javascript">

  var wrap = $('.char-wrapper');
  var text = wrap.text();
  console.log(text);
  wrap.each(function(i) {

    if (this.text == 0) {

      this.text = 'no';
    } else if(this.text == 1){

      this.text = 'sì';
    }
  });
</script>

@stop
