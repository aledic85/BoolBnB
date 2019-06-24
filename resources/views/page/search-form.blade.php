@extends('layout.home-layout')

@section('content')

  <div class="wrapper">
    <div class="container dashB">
      <div class="boxForm">
        <form class="search-form" action="">
          @csrf
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
              <option value="">--</option>
              <option value="0">No</option>
              <option value="1">Sì</option>
            </select><br>
            <label for="parking_space">Parking_space</label>
            <select name="parking_space">
              <option value="">--</option>
              <option value="0">No</option>
              <option value="1">Sì</option>
            </select><br>
            <label for="pool">Pool</label>
            <select name="pool">
              <option value="">--</option>
              <option value="0">No</option>
              <option value="1">Sì</option>
            </select><br>
            <label for="sauna">Sauna</label>
            <select name="sauna">
              <option value="">--</option>
              <option value="">No</option>
              <option value="1">Sì</option>
            </select><br>
            <button type="submit">Search!</button>
          </div>
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

// Stampa dinamica risultati ricerca

    $( "form" ).submit(function( event ) {

      event.preventDefault();
      $('.box-apartments').remove();

      var dataArr = $( 'form' ).serializeArray();

      var data = dataArr.reduce(function ( total, current ) {
        total[ current.name ] = current.value;
        return total;
      }, {});

      $.ajax({

        url: '/search/results',
        method: 'GET',
        data: data,
        success: function(inData) {

          for (var i = 0; i < inData.length; i++) {

            var res = inData[i];
            var img_path = res.img_path;
            var title = res.title;
            var description = res.description;
            var address = res.address;
            var rooms = res.rooms;
            var beds = res.beds;
            var bathrooms = res.bathrooms;
            var mq = res.mq;
            var wi_fi = res.wi_fi;
            var parking_space = res.parking_space;
            var pool = res.pool;
            var sauna = res.sauna;

            var outData = {

              img_path: img_path,
              title: title,
              description: description,
              address: address,
              rooms: rooms,
              beds: beds,
              bathrooms: bathrooms,
              mq: mq,
              wi_fi: wi_fi,
              parking_space: parking_space,
              pool: pool,
              sauna: sauna
            }

            var template = $("#template").html();
            var compiled = Handlebars.compile(template);
            var finalHTML = compiled(outData);

            $(".wrapper").append(finalHTML);
          }
        }
      });

    });
// Fine stampa dinamica risultati ricerca
  </script>
@endsection
