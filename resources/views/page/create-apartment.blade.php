@extends('layout.home-layout')

@section('content')
  <div class="wrapper">
    <div class="container dashB">
      <h2>Inserisci un nuovo appartamento</h2>
      <p>compila i seguenti campi, inserendo una tua proprietà da mettere in affitto. Inizia a guadagnare da oggi!</p>

      <div class="boxForm">
        <form action="{{ route('store.new.apart') }}" method="post">
          @csrf
          <label for="img_path">Immagine</label>
          <input type="text" name="img_path" value="{{ old('img_path') }}"><br>
          <label for="title">Nome Appartamento</label>
          <input type="text" name="title" value="{{ old('title') }}"><br>
          <label for="description">Descrizione</label>
          <input type="text" name="description" value="{{ old('description') }}"><br>
          <label for="">Indirizzo</label>
          <input type="text" name="" value=""><br>
          <label for="rooms">Numero stanze</label>
          <input type="text" name="rooms" value="{{ old('rooms') }}"><br>
          <label for="beds">Numero letti</label>
          <input type="text" name="beds" value="{{ old('beds') }}"><br>
          <label for="bathrooms">Numero bagni</label>
          <input type="text" name="bathrooms" value="{{ old('bathrooms') }}"><br>
          <label for="mq">Metri quadrati</label>
          <input type="text" name="mq" value="{{ old('mq') }}"><br><br>
          <button type="submit" name="store">INSERISCI</button>
        </form>
      </div>
    </div>
  </div>

@stop
