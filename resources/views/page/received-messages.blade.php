@extends('layout.home-layout')

@section('content')

<h3>I messaggi dai tuoi clienti</h3>
    <table>
      <tr>
        <th>Name</th>
        <th>Lastname</th>
        <th>Apartment</th>
        <th>Email</th>
        <th>Message title</th>
        <th>Message content</th>
      </tr>
      @foreach ($messages as $message)
        <tr>
          <td>{{ $message->name }}</td>
          <td>{{$message->lastname}}</td>
          <td>{{$message->description}}</td>
          <td>{{$message->email}}</td>
          <td>{{$message->title}}</td>
          <td>{{$message->content}}</td>
        </tr>
      @endforeach
    </table>
@endsection
