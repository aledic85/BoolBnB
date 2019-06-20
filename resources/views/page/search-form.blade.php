@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="container dashB">
      <div class="boxForm">
        <form class="" action="{{ route('search.results')}}">
          <label for="title">Nome Appartamento</label>
          <input type="text" name="title" value="">
          <label for="description">Descrizione</label>
          <input type="text" name="description" value=""><br>
          <label for="address">Indirizzo</label>
          <input type="search" id="address-input" name="address" placeholder="Inserisci indirizzo" />
          <p id="location-output">Luogo Selezionato: <strong id="address-value">Nessuno</strong></p>
          <input id="latval" type="hidden" name="latitude" value="">
          <input id="lonval" type="hidden" name="longitude" value="">
          <label for="rooms">Numero stanze</label>
          <input type="text" name="rooms" value=""><br>
          <label for="beds">Numero letti</label>
          <input type="text" name="beds" value=""><br>
          <label for="bathrooms">Numero bagni</label>
          <input type="text" name="bathrooms" value=""><br>
          <label for="mq">Metri quadrati</label>
          <input type="text" name="mq" value="">
          <div class="opt-services">
            <label for="wi-fi">Wi-Fi</label>
            <select name="wi_fi">
              <option value="0">--</option>
              <option value="0">No</option>
              <option value="1">Sì</option>
            </select><br>
            <label for="parking_space">Parking_space</label>
            <select name="parking_space">
              <option value="0">--</option>
              <option value="0">No</option>
              <option value="1">Sì</option>
            </select><br>
            <label for="pool">Pool</label>
            <select name="pool">
              <option value="0">--</option>
              <option value="0">No</option>
              <option value="1">Sì</option>
            </select><br>
            <label for="sauna">Sauna</label>
            <select name="sauna">
              <option value="0">--</option>
              <option value="0">No</option>
              <option value="1">Sì</option>
            </select><br>
            <button type="submit">Search!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
