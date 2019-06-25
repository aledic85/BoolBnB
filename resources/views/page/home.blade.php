@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="search">
      <div class="trisImg">
        <img src="{{ asset('img/stagione_estate_038.jpg') }}">
        <div class="headertitle">
          <img src="{{ asset('img/b&b_lusso.jpeg') }}">
          <img src="{{ asset('img/b&b_lusso3.jpeg') }}">
          <img src="{{ asset('img/b&b_lusso2.jpeg') }}">
          <h1>PRONTO<br> PER<br> UNA<br> NUOVA<br> ESPERIENZA<br>?</h1>
        </div>
      </div>
      <div class="search-items">
        <form class="" action="{{ route('search.by.city')}}">
          <div class="box-search-items">
            <input type="search" id="city" name="address" placeholder="Inserisci indirizzo" />
            <input type="hidden" name="ids[]" value="null">
            <button type="submit" class="goSearch">Vai!</button>
          </div>
        </form>
        <a class="advSearch" href="{{ route('search.apart') }}">Ricerca avanzata</a>
      </div>
    </div>
    <div class="homeP">
      <div class="title">
        <h2>Appartamenti in Evidenza</h2>
      </div>
      <div class="box-apartments">
        @foreach ($sponsoredApartments as $sponsoredApartment)
          <div class="box-apartment rounded-bottom">
            <a class="dets" href="{{ route('show.apart', $sponsoredApartment->id) }}">
              <div class="box-image">
                <img src="{{ URL::to('/storage') }}/images/{{ $sponsoredApartment->img_path }}">
              </div>
              <div class="box-data">
                <h3>{{ $sponsoredApartment -> title }}</h3>
                <p class="descr">{{ $sponsoredApartment -> description }}</p>
                <p class="addr">{{ $sponsoredApartment -> address }}</p>
              </div>
            </a>
          </div>
        @endforeach
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

            var searchForm = $('.box-search-items');

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

  </script>
@endsection
