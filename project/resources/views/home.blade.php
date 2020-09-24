@extends('template')


@section('content')
@guest
    @include('home-guest')
@endguest

@auth
    @include('home-auth')
@endauth
@endsection