@extends('layout.home-layout')

@section('content')

  <form class="" action="{{ route('payment.success', $id) }}" method="post">
    @csrf
    @method('POST')
    <label for="title">Tipo di sponsorizzazione</label>
    <select class="payment" name="hours">
      <option value="24">Un giorno - 8 euro</option>
      <option value="168">Una settimana - 40 euro</option>
      <option value="672">Un mese - 150 euro</option>
    </select>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div id="dropin-container"></div>
          <button id="submit-button">Paga ora!</button>
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
     button.addEventListener('click', function () {
       instance.requestPaymentMethod(function (err, payload) {
         $.get('{{ route('payment.process') }}', {payload}, function (response) {
           if (response.success) {

           } else {
             alert('Payment failed');
           }
         }, 'json');
       });
     });
   });
 </script>


@endsection
