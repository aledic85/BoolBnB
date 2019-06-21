@extends('layout.home-layout')

@section('content')


  @foreach ($messages as $message)
    <p>Name: {{ $message->name }}</p>
    <p>Lastname: {{$message->lastname}}</p>
    <p>Lastname: {{$message->email}}</p>
    <p>Lastname: {{$message->title}}</p>
    <p>Lastname: {{$message->content}}</p>
  @endforeach
@endsection
