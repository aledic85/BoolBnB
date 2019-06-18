@extends('layout.home-layout')

@section('content')
<div class="wrapper">
  <div class="container dashB">
    <div class="boxAddNew">
      <h2>Benvenuto nella tua dashboard {{ Auth::user() -> find(10) -> name }}</h2>
      <form class="" action="{{ route('new.apart') }}" method="get">
        @csrf
        @method('POST')
        <button type="submit" name="create">AGGIUNGI APPARTAMENTO</button>
      </form>
    </div>
    <div class="box-apartments">
      @foreach ($apartments as $apartment)
        <div class="box-apartment rounded-bottom">
          <img src="{{ $apartment -> img_path }}">
          <div class="infoAp p-2">
            <h3>{{ $apartment -> title }}</h3>
            <p>{{ $apartment -> description }}</p>
            <span>Via Giuseppe Garibaldi, 11A {{ $apartment -> latitude }} {{ $apartment -> longitude }}</span>
            <ul>
              <li>Numero stanze: {{ $apartment -> rooms }}</li>
              <li>Numero letti: {{ $apartment -> beds }}</li>
              <li>Numero bagni: {{ $apartment -> bathrooms }}</li>
              <li>Metri quadrati: {{ $apartment -> mq }}</li>
            </ul>
            <form class="ed" action="#" method="post">
              @csrf
              @method('PATCH')
              <button type="submit" name="edit">MODIFICA</button>
            </form>
            <form class="del" action="#" method="post">
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

@stop
