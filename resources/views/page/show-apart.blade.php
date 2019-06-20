@extends('layout.home-layout')
    @section('content')

      <div class="details">
          <div class="img-container">
              <img src="{{$apartment->img_path}}">
          </div>
          <div class="details-middle">
              <div class="middle-left">
                <h4>{{$apartment->title}}</h4>
                <span>{{$apartment->title}}</span>
                <p>{{$apartment->description}}</p>
              </div>
              <div class="middle-right">
                  <ul>
                    <li>Rooms : {{ $apartment->rooms }}</li>
                    <li>Mq : {{ $apartment->mq }}</li>
                    <li>Beds : {{ $apartment->beds }}</li>
                    <li>Bathroom : {{ $apartment->bathrooms }}</li>
                    <li>Wi-Fi : <span>{{ $apartment->wi_fi }}</span></li>
                    <li>Parking Space : <span>{{ $apartment->parking_space }}</span></li>
                    <li>Sauna : <span>{{ $apartment->sauna }}</span></li>
                    <li>Pool : <span>{{ $apartment->pool }}</span></li>
                  </ul>
              </div>
          </div>
          <div class="details-down">
              <div class="down-left">
                  <div class="map-container">
                     <div id="map"></div>
                  </div>
              </div>
              <div class="down-right">
                  <h1>Scrivi al Proprietario</h1>
                  <form class="" action="{{route('send.mail', $apartment->user_id)}}" method="post">
                    @csrf
                    @method('POST')
                    <label for="title">Title:</label><br>
                    <input type="text" name="title" value=""><br>
                    <label for="title">Name:</label><br>
                    <input type="text" name="name" value=""><br>
                    <label for="title">Lastname:</label><br>
                    <input type="text" name="lastname" value=""><br>
                    <label for="title">Email:</label><br>
                    <input type="text" name="email" value=""><br>
                    <label for="description">Description:</label><br>
                    <textarea name="description" rows="8" cols="80"></textarea><br><br>
                    <button type="submit" name="button">Send</button>
                  </form>
              </div>
          </div>
      </div>
      <script>
          tomtom.setProductInfo('BoolBnB', '1.0');

          var lat = {{$apartment->latitude}};
          var long = {{$apartment->longitude}};
          var title = "{{$apartment->title}}";
          var description = "{{$apartment->description}}";

          var myLocation = [lat, long];
          var map = tomtom.L.map('map', {
              key: "kvaWo21VAPIFQF2qQjTTzA2brbzqOTRy",
              basePath: '<sdk>',
              center: myLocation,
              zoom: 15
          });

          var marker = tomtom.L.marker(myLocation, {
                      title: "Dettagli",
                      icon: tomtom.L.icon({
                        iconUrl: "{{asset('img/marker.png')}}",
                        // iconSize: [50, 75],
                        iconAnchor: [17, 70],
                        popupAnchor: [5, -80]
                        })
                    }).addTo(map);
              marker.bindPopup("<b>" + title + "</b><br/>" + description);

              var wrap = $('ul > li > span');

              wrap.each(function() {

                if ($(this).text() == '0') {

                  $(this).text('no');
                } else if ($(this).text() == '1') {

                  $(this).text('sì');
                }
              });
      </script>


@stop
