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
          <input type="search" id="city" name="address" placeholder="Inserisci indirizzo" />
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
  function getPosition(string) {

    $.ajax({
      url : "https://api.tomtom.com/search/2/search/" + string + ".json?key=kvaWo21VAPIFQF2qQjTTzA2brbzqOTRy",
      method: "GET",
      success: function(apiData, stato) {

        if (stato === "success") {

          // console.log(apiData);
          var results = apiData.results;

          if (results.length > 0) {

            var result = results[0];
            var position = result["position"];
            // console.log(position);
            var lat = position.lat;
            var lon = position.lon;


            postCompilerTomTom(lat,lon);
          }

          else {

            alert('Nessun Risultato');
          }
        }
      },
      error: function(richiesta, stato, errori) {
        console.log("Errori di connessione " + errori);
      }
    });
  }

  function postCompilerTomTom(float1, float2) {

    var lat = {!! json_encode($lat->toArray()) !!};
    var latValues = lat.map(function (obj) {
      return obj.latitude;
    });

    var long = {!! json_encode($long->toArray()) !!};
    var longValues = long.map(function (obj) {
      return obj.longitude;
    });

    var id = {!! json_encode($ids->toArray()) !!};
    var idValues = id.map(function (obj) {
      return obj.id;
    });

    $.getJSON('body.json', function(data) {
      // Inserisco lat e lon di epicentro ricerca
      data.geometryList[0].position = float1 + "," + float2;
      // Prendo l'array della lista di appartamenti che è vuoto
      var appartmentsList = data.poiList;
      // Prendo il model del JSON e Simulo il push di altri elementi oltre al primo già presente
      for (var i = 0; i < latValues.length; i++) {
        var newElement = {
          "poi": {
            "id": idValues[i]
          },
          "position": {
            "lat": latValues[i],
            "lon": longValues[i]
          }
        };
        appartmentsList.push(newElement);
      }
      // console.log(data);
      getTomTomData(data);
    });
  }

  function getTomTomData(object) {

    var jsonForServer = JSON.stringify(object);
    $.ajax({
      url : "https://api.tomtom.com/search/2/geometryFilter.json?key=kvaWo21VAPIFQF2qQjTTzA2brbzqOTRy",
      type: "POST",
      data : jsonForServer,
      contentType: 'application/json',
      dataType: "json",
      success : function(apiData, stato) {

        if (stato === "success") {


          var numResults = apiData.summary.numResults;


          if (numResults > 0) {

            var searchForm = $('.search-form');

            for (var i = 0; i < apiData.summary.numResults; i++) {
              var lat = apiData.results[i].position.lat;
              var lon = apiData.results[i].position.lon;
              var id = apiData.results[i].poi.id;
              var input = document.createElement("input");
              input.type = "hidden";
              input.name = "ids[]";
              input.className = "id";
              input.value = id;

              searchForm.append(input);
            }
          }
          else {
            searchForm.children("input.id").remove;
          }
        }
      },
      error : function(richiesta, stato, errori) {

        console.log("Errori di connessione " + errori);
      }
    });
  }
  // Inizio init
    // Inizio Geocomplete x city
    var placesAutocomplete = places({
      appId: 'plNDBGJCABTM',
        apiKey: '058ea8ab45c3047be146c1aa42cc50ab',
          container: document.querySelector('#city'),
          templates: {
            value: function(suggestion) {
              return suggestion.name;
            }
          }
        }).configure({
          type: 'city',
          aroundLatLngViaIP: false,
        });
      // Fine Geocomplete x city

          // Inizio Aggiornamento in h1 in real time
         placesAutocomplete.on('change', function(e) {

           getPosition(e.suggestion.value);
        });
          placesAutocomplete.on('clear', function() {
            $('input.id').remove();
         });
         // Fine Aggiornamento in h1 in real time
      // Fine init

// Stampa dinamica risultati ricerca

    $( "form" ).submit(function( event ) {

      event.preventDefault();
      $('.box-apartments').remove();

      var dataArr = $( 'form' ).serializeArray();

      $.ajax({

        url: '/search/results',
        method: 'GET',
        data: dataArr,
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
