@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="container dashB">
      <h2>Modifica appartamento</h2>
      <p>compila i seguenti campi, inserendo una tua proprietà da mettere in affitto. Inizia a guadagnare da oggi!</p>

      <div class="boxForm">
        <form action="{{ route('update.apart', $apartment->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('POST')
          <label for="img_path">Immagine</label>
          <input type="file" name="img_path" value=""><br>
          <label for="title">Nome Appartamento</label>
          <input type="text" name="title" value="{{$apartment->title}}"><br>
          <label for="description">Descrizione</label>
          <input type="text" name="description" value="{{$apartment->description}}"><br>
          <label for="address">Indirizzo</label>
          <input type="search" id="address-input" name="address" placeholder="Inserisci indirizzo" />
          <p id="location-output">Luogo Selezionato: <strong id="address-value">Nessuno</strong></p>
          <input id="latval" type="hidden" name="latitude" value="">
          <input id="lonval" type="hidden" name="longitude" value="">
          <label for="rooms">Numero stanze</label>
          <input type="text" name="rooms" value="{{$apartment->rooms}}"><br>
          <label for="beds">Numero letti</label>
          <input type="text" name="beds" value="{{$apartment->beds}}"><br>
          <label for="bathrooms">Numero bagni</label>
          <input type="text" name="bathrooms" value="{{$apartment->bathrooms}}"><br>
          <label for="mq">Metri quadrati</label>
          <input type="text" name="mq" value="{{$apartment->mq}}"><br><br>
          <label for="wi-fi">Wi-Fi</label>
          <select name="wi_fi">
            <option value="{{$apartment->wi_fi}}">{{$apartment->wi_fi}}</option>
            <option value="0">No</option>
            <option value="1">Sì</option>
          </select><br>
          <label for="parking_space">Parking_space</label>
          <select name="parking_space">
            <option value="{{$apartment->parking_space}}">{{$apartment->parking_space}}</option>
            <option value="0">No</option>
            <option value="1">Sì</option>
          </select><br>
          <label for="pool">Pool</label>
          <select name="pool">
            <option value="{{$apartment->pool}}">{{$apartment->pool}}</option>
            <option value="0">No</option>
            <option value="1">Sì</option>
          </select><br>
          <label for="sauna">Sauna</label>
          <select name="sauna">
            <option value="{{$apartment->sauna}}">{{$apartment->sauna}}</option>
            <option value="0">No</option>
            <option value="1">Sì</option>
          </select><br>
          <label for="active">Rendere annuncio attivo?</label>
          <select name="active">
            <option value="{{$apartment->active}}">{{$apartment->active}}</option>
            <option value="0">No</option>
            <option value="1">Sì</option>
          </select><br>
          <button type="submit" name="">INSERISCI</button>
        </form>
      </div>
    </div>
  </div>
@stop
