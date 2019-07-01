@extends('layout.home-layout')

@section('content')
  <div class="succ-wrap">
    <i class="far fa-check-circle"></i>
    <h2>Transazione avvenuta con successo!</h2>
    <a href="{{route('dashboard')}}"><button type="button" name="button">Torna alla dashboard</button></a>
  </div>
@endsection
