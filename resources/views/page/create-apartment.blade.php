@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="container dashB">
      <h2>Inserisci un nuovo appartamento</h2>
      <p>compila i seguenti campi, inserendo una tua proprietà da mettere in affitto. Inizia a guadagnare da oggi!</p>

      <div class="boxForm">
        <form id="form" action="{{ route('store.new.apart') }}" method="post" enctype="multipart/form-data">
          @csrf
          <label for="img_path">Immagine</label>
          <input type="file" name="img_path" value=""><br>
          <label for="title">Nome Appartamento</label>
          <input type="text" name="title" value=""><br>
          <label for="description">Descrizione</label>
          <input type="text" name="description" value=""><br>
          <label for="indirizzo">Indirizzo</label>
          <input type="search" id="address-input" name="indirizzo" placeholder="Inserisci indirizzo" />
          <p>Luogo Selezionato: <strong id="address-value">Nessuno</strong></p><br>
          <input id="latval" type="hidden" name="latitude" value="">
          <input id="lonval" type="hidden" name="longitude" value="">
          <label for="rooms">Numero stanze</label>
          <input type="text" name="rooms" value=""><br>
          <label for="beds">Numero letti</label>
          <input type="text" name="beds" value=""><br>
          <label for="bathrooms">Numero bagni</label>
          <input type="text" name="bathrooms" value=""><br>
          <label for="mq">Metri quadrati</label>
          <input type="text" name="mq" value=""><br><br>
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
          <label for="active">Rendere annuncio attivo?</label>
          <select name="active">
            <option value="0">--</option>
            <option value="0">No</option>
            <option value="1">Sì</option>
          </select><br>
          <button type="submit" name="">INSERISCI</button>
        </form>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/additional-methods.min.js"></script>
      </div>
    </div>
  </div>
@stop
