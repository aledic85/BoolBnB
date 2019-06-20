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
          <input type="search" id="address-input" name="address" value="{{$apartment->address}}" placeholder="Inserisci indirizzo" />
          <p id="location-output">Luogo Selezionato: <strong id="address-value">{{$apartment->address}}</strong></p>
          <input id="latval" type="hidden" name="latitude" value="{{$apartment->latitude}}">
          <input id="lonval" type="hidden" name="longitude" value="{{$apartment->longitude}}">
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
