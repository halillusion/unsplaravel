@extends('layouts.app')
@section('title', 'Home')
@section('content')
    @foreach ($photos as $photo)
        <p>This is user {{ $photo->artist->name }}</p>
    @endforeach
@endsection