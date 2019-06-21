@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="container dashB">
      <h2>Inserisci un nuovo appartamento</h2>
      <p>compila i seguenti campi, inserendo una tua proprietà da mettere in affitto. Inizia a guadagnare da oggi!</p>

      <div class="boxForm">
        <form action="{{ route('store.new.apart') }}" method="post" enctype="multipart/form-data">
          @csrf
          <label for="img_path">Immagine</label>
          <input type="file" name="img_path" value=""><br>
          <label for="title">Nome Appartamento</label>
          <input type="text" name="title" value=""><br>
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
            <label for="active">Rendere annuncio attivo?</label>
            <select name="active">
              <option value="0">--</option>
              <option value="0">No</option>
              <option value="1">Sì</option>
            </select><br>
            <button type="submit" name="">INSERISCI</button>
          </div>
        </form>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/additional-methods.min.js"></script>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  // Inizio Funzioni tomtom
  function getPosition(string) {

    $.ajax({
      url : "https://api.tomtom.com/search/2/search/" + string + ".json?key=kvaWo21VAPIFQF2qQjTTzA2brbzqOTRy",
      method: "GET",
      success: function(apiData, stato) {

        if (stato === "success") {

          // console.log(apiData);
          var results = apiData.results;
          var latval = $("#latval");
          var lonval = $("#lonval");

          if (results.length > 0) {

            var result = results[0];
            var position = result["position"];
            // console.log(position);
            var lat = position.lat;
            var lon = position.lon;

                latval.val(lat);
                lonval.val(lon);

          }

          else {

                latval.val(" ");
                lonval.val(" ");
          }
        }
      },
      error: function(richiesta, stato, errori) {
        console.log("Errori di connessione " + errori);
      }
    });
  }



  function getQuery() {

    var placesAutocomplete = places({
    appId: "plNDBGJCABTM",
    apiKey: "058ea8ab45c3047be146c1aa42cc50ab",
    container: document.querySelector('#address-input')
    });

    var $address = document.querySelector('#address-value')
     placesAutocomplete.on('change', function(e) {
       $address.textContent = e.suggestion.value

       var query = $("#address-value").text();
       getPosition(query);
    });

   placesAutocomplete.on('clear', function() {
     $address.textContent = 'Nessuno';

     var latval = $("#latval").val(" ");
     var lonval = $("#lonval").val(" ");
    });

  }
  // Fine Funzion tomtom
    getQuery();
  </script>
@stop
