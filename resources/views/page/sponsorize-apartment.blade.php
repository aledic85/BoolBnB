@extends('layout.home-layout')

@section('content')

  <form class="" method="get">
    @csrf
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center mt-5">
          <label for="title">Tipo di sponsorizzazione</label>
          <select class="payment" name="hours">
            <option value="24">Un giorno - 8 euro</option>
            <option value="168">Una settimana - 40 euro</option>
            <option value="672">Un mese - 150 euro</option>
          </select>
          <input type="hidden" name="id" value="{{$id}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 paybox">
          <div id="dropin-container"></div>
          <div class="row">
            <div class="col-md-12 text-center mb-5">
              <button id="submit-button">Paga ora!</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

<script type="text/javascript">

  var button = document.querySelector('#submit-button');

  braintree.dropin.create({
    authorization: "{{ Braintree_ClientToken::generate() }}",
    container: '#dropin-container'
   },
   function (createErr, instance) {
     button.addEventListener('click', function (event) {
       event.preventDefault();
       instance.requestPaymentMethod(function (err, payload) {
         $.get('{{ route('payment.process') }}', {payload}, function (response) {
           if (response.success) {

             var dataArr = $( 'form' ).serializeArray();
             $.ajax({
               url: '/dashboard/payment/success/{id}',
               method: 'GET',
               data: dataArr,
               success: function(inData) {

                 window.location.replace("http://localhost/dashboard/sponsorship-success");
               }

             });
           } else {
             alert('Payment failed');
           }
         }, 'json');
       });
     });
   });
 </script>


@endsection
