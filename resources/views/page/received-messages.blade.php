@extends('layout.home-layout')

@section('content')
  <style media="screen">
    .prova{
      width: 100vw;
      height: 100vh;
      background-color: #00000090;
      position: fixed;
      top: 0;
      z-index: 100;
      display: none;
    }
    .box1{
      width: 600px;
      height: 300px;
      background-color: white;
      border-radius: 5px;
      margin: auto;
      padding: 30px;
      text-align: center;
      position: relative;
      word-wrap: break-word;
      margin: auto;
      margin-top: 150px;
    }

    #close{
      cursor: pointer;
      position: absolute;
      top: 6px;
      right: 15px;
    }

    td[data-content]{
      cursor: pointer;
    }

    tr:first-child {
      background: darkgrey;
      text-transform: uppercase;
      text-align: center;
    }

    tr:nth-child(2n+3) {
      background: #cecece90;
    }

    table{
      box-shadow: #0009 12px 12px 25px;
      margin: 30px auto;
    }

    .table-wrap {

      width: 95%;
      margin: auto;
    }

    .hover:hover {

      background-color: #cecece;
    }

    @media all and (max-width: 620px) {

      .box1 {

        width: 350px;
      }

      .table-wrap {

        overflow-x: auto;
        border-collapse: collapse;
        border-spacing: 0;
      }

      table {

        box-shadow: none;
      }
    }
  </style>

  <div class="prova">
    <div class="box1">
      <span id="close"><i class="fas fa-window-close"></i></span>
      <h3>Corpo del messaggio:</h3>
      <p id="popup-text"></p>
    </div>
  </div>
    <div class="table-wrap">
      <table>
        <tr>
          <th>Name</th>
          <th>Lastname</th>
          <th>Apartment</th>
          <th>Email</th>
          <th>Message title</th>
          <th>Message content</th>
          <th>Delete Message</th>
        </tr>
        @foreach ($messages as $message)
          <tr>
            <td>{{ $message->name }}</td>
            <td>{{$message->lastname}}</td>
            <td>{{$message->description}}</td>
            <td>{{$message->email}}</td>
            <td>{{$message->title}}</td>
            @php
            $msg = $message->content;
            $length = 25;
            $fix = substr($msg, 0, $length);

            if (strlen($msg) > $length) {
              $msg = $fix . "...";
            }
            @endphp
            <td class="hover" data-content="{{$message ->content}}">{{$msg}}</td>
            <td class="text-center"><form class="del" action="{{route('delete.mess', $message->id)}}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" name="delete"><i class="far fa-trash-alt popup">
              </i></button>
            </form></td>
          </tr>
        @endforeach
      </table>
    </div>

    <script type="text/javascript">

      var box = $('.prova');
      var cont = $('[data-content]');
      var x = $('#close');

      cont.click(function() {
        var me = $(this);
        var val = me.data('content');
        $('#popup-text').text(val);
        box.fadeIn();
      });

      x.click(function() {
        box.fadeOut();
      });

      $(document).ready(function(){
        setTimeout(function(){
           $("div.alert").fadeOut();
        }, 3000 );
      });
    </script>
@endsection
