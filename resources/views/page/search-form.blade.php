@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="container dashB">
      <div class="boxForm">
        <form class="search-form" action="">
          @csrf
          <span class="genErr">DEVI COMPILARE ALMENO UN CAMPO</span>
          <label for="title">Nome Appartamento</label>
          <input type="text" name="title" value="" class="input-form aprt_group">
          <label for="description">Descrizione</label>
          <input type="text" name="description" value="" class="input-form aprt_group"><br>
          <label for="address">Indirizzo</label>
          <input type="search" id="city" class="input-form aprt_group" name="address" placeholder="Inserisci indirizzo" />
          <input type="hidden" name="ids" value="">
          <label for='radius'>Distanza in Km</label>
          <input type="number" id="radius" value="20">
          <label for="rooms">Numero stanze</label>
          <input type="text" name="rooms" value="" class="input-form aprt_group"><br>
          <label for="beds">Numero letti</label>
          <input type="text" name="beds" value="" class="input-form aprt_group"><br>
          <label for="bathrooms">Numero bagni</label>
          <input type="text" name="bathrooms" value="" class="input-form aprt_group"><br>
          <label for="mq">Metri quadrati</label>
          <input type="text" name="mq" value="" class="input-form aprt_group">
          <div class="opt-services">
            <label for="wi_fi">Wi-Fi</label>
            <select name="wi_fi" class="input-form aprt_group">
              <option value="">--</option>
              <option value="0">No</option>
              <option value="1">Sì</option>
            </select><br>
            <label for="parking_space">Parking_space</label>
            <select name="parking_space" class="input-form aprt_group">
              <option value="">--</option>
              <option value="0">No</option>
              <option value="1">Sì</option>
            </select><br>
            <label for="pool">Pool</label>
            <select name="pool" class="input-form aprt_group">
              <option value="">--</option>
              <option value="0">No</option>
              <option value="1">Sì</option>
            </select><br>
            <label for="sauna">Sauna</label>
            <select name="sauna" class="input-form aprt_group">
              <option value="">--</option>
              <option value="">No</option>
              <option value="1">Sì</option>
            </select><br>
            <button type="submit" class="searchBtn">Search!</button>
          </div>
        </form>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/additional-methods.min.js"></script>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
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
      data.geometryList[0].radius = ($('#radius').val() * 1000);
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
            var searchForm = $('.search-form');
            var input = document.createElement("input");
            input.type = "hidden";
            input.name = "ids[]";
            input.className = "id";
            input.value = 0;

            searchForm.append(input);
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
      $('.homeP').remove();

      var hasInput=false;

         $('.input-form').each(function () {
           var val = $(this).val();

          if(val !== ""){
           hasInput = true;
          }
         });

         if(!hasInput){

           $('.genErr').css('display', 'block');

           setTimeout(function() {

               $('.genErr').fadeOut();
             }, 10000);
             
          }else{

             var dataArr = $( 'form' ).serializeArray();

             $.ajax({

               url: '/search/results',
               method: 'GET',
               data: dataArr,
               success: function(inData) {

                 for (var i = 0; i < inData.length; i++) {

                   var res = inData[i];
                   var id = res.id;
                   var img_path = res.img_path;
                   var title = res.title;
                   var description = res.description;
                   var address = res.address;
                   var sponsored = res.end_sponsored;
                   var now = moment().format('YYYY-MM-DD HH:MM:SS');

                   console.log(now);
                   console.log(sponsored);

                   var outData = {

                     id: id,
                     img_path: img_path,
                     title: title,
                     description: description,
                     address: address,
                     now: now,
                     sponsored : sponsored
                   }
                   Handlebars.registerHelper('containsHttp', function(img_path){

                     if(img_path.includes('https')) {

                       var result = '<img src="' + img_path +'">';

                       return new Handlebars.SafeString(result);
                     }else {
                       var result2 = '<img src="/storage/images/' + img_path+ '">';

                       return new Handlebars.SafeString(result2);
                     }
                   });

                   Handlebars.registerHelper('isSponsored', function(now, sponsored) {

                     if (sponsored > now) {

                       return "sponsored";
                     }
                   });

                   Handlebars.registerHelper('showApart', function(id) {

                     var url = '/show/' + id;

                     return url;
                   });
                   var template = $("#template").html();
                   var compiled = Handlebars.compile(template);
                   var finalHTML = compiled(outData);

                   $(".wrapper").append(finalHTML);
                 }
               }
             });
          }
    });
// Fine stampa dinamica risultati ricerca

  </script>
  @endsection
