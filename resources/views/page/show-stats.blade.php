@extends('layout.home-layout')

@section('content')

 <h1>Numero totale visualizzazioni appartamento = {{$totalViews}}</h1>
 <h1>Numero totale messaggi ricevuti appartamento = {{$totalMessages}}</h1>
 <div class="chart-cont">
   <canvas id="myChart"></canvas>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
 <script type="text/javascript">

  var months = {!! json_encode($months) !!};

  var month = [], views = [], prev;

  for ( var i = 0; i < months.length; i++ ) {
      if ( months[i] !== prev ) {
          month.push(months[i]);
          views.push(1);
      } else {
          views[views.length-1]++;
      }
      prev = months[i];
  }

  console.log(views);


 var ctx = document.getElementById('myChart').getContext('2d');
 var chart = new Chart(ctx, {

   type: 'bar',

   // The data for our dataset
   data: {
       labels: month,
       datasets: [{
           label: 'Visualizzazioni per mese',
           backgroundColor: ['red', 'blue'],
           borderColor: 'rgb(255, 99, 132)',
           data: views
       }]
   },

   // Configuration options go here
   options: {}
});

 </script>
@endsection
