@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="container dashB">
      <h2>Modifica appartamento</h2>

      <div class="boxForm">
        <form action="{{ route('update.apart', $apartment->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('POST')
          <label for="img_path">Immagine</label>
          <input type="file" name="img_path" value="{{$apartment->img_path}}"><br>
          <label for="title">Nome Appartamento</label>
          <input type="text" name="title" value="{{$apartment->title}}"><br>
          <label for="description">Descrizione</label>
          <input type="text" name="description" value="{{$apartment->description}}"><br>
          <label for="latitude">Latitudine</label>
          <input type="text" name="latitude" value="{{$apartment->latitude}}"><br>
          <label for="">Longitudine</label>
          <input type="text" name="longitude" value="{{$apartment->longitude}}"><br>
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
