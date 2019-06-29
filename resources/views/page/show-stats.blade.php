@extends('layout.home-layout')

@section('content')
 <div class="stats">
      <div class="stats-left">
          <i class="fas fa-eye fa-2x"></i>
          <h2>Numero totale visualizzazioni appartamento = {{$totalViews}}</h1>
      </div>
      <div class="stats-right">
          <i class="fas fa-inbox fa-2x"></i>
          <h2>Numero totale messaggi ricevuti appartamento = {{$totalMessages}}</h1>
      </div>
  </div>
 <div class="chart-cont">
   <canvas id="myChart"></canvas>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
 <script type="text/javascript">

  var views = {{$totalViews}};
  var months = {!! json_encode($months) !!};

  var uniqueMonths = [];
    $.each(months, function(i, el){
      if($.inArray(el, uniqueMonths) === -1) uniqueMonths.push(el);
    });

 var ctx = document.getElementById('myChart').getContext('2d');
 var chart = new Chart(ctx, {

   type: 'bar',

   // The data for our dataset
   data: {
       labels: uniqueMonths,
       datasets: [{
           label: 'Visualizzazioni per mese',
           backgroundColor: 'rgb(255, 99, 132)',
           borderColor: 'rgb(255, 99, 132)',
           data: [views]
       }]
   },

   // Configuration options go here
   options: {}
});

 </script>
@endsection
