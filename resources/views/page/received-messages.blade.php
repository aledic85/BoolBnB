@extends('layout.home-layout')

@section('content')


  @foreach ($messages as $message)
    <p>Name: {{ $message->name }}</p>
    <p>Lastname: {{$message->lastname}}</p>
    <p>Email: {{$message->email}}</p>
    <p>Title: {{$message->title}}</p>
    <p>Content: {{$message->content}}</p>
  @endforeach
@endsection
