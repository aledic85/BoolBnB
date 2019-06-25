@extends('layout.home-layout')

@section('content')
 <h1>Numero totale visualizzazioni appartamento = {{$totalViews}}</h1>
 <h1>NUmero totale messaggi ricevuti appartamento = {{$totalMessages}}</h1>
 <script type="text/javascript">

//  var ctx = document.getElementById('myChart').getContext('2d');
//  var chart = new Chart(ctx, {
//
//    type: 'line',
//
//    // The data for our dataset
//    data: {
//        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
//        datasets: [{
//            label: 'My First dataset',
//            backgroundColor: 'rgb(255, 99, 132)',
//            borderColor: 'rgb(255, 99, 132)',
//            data:
//        }]
//    },
//
//    // Configuration options go here
//    options: {}
// });

 </script>
@endsection
