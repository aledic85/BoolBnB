require('./bootstrap');
// var $ = require('jquery');



function trimString(titleText) {

  var length = 3;
  var trimmedString = titleText.substring(0, length);
}


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

function init() {

  var title = $(".appartments_container > h3");
  var titleText = title.text();

  trimString(titleText);
  getQuery();
}

$(document).ready(init);
