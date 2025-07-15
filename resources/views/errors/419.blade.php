@extends('errors::minimal')

@section('code', '419')
@section('message')
    Your session has expired due to inactivity. <br> Please refresh the page or
    <a class="text-waitt-pink-400 hover:text-waitt-pink-600 underline" href="/login">log in</a>  again to continue.
@endsection
