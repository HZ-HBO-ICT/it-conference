@extends('errors::minimal')

@section('code', '403')
@section('message')
    You do not have the necessary permissions to view this page. <br>
    If you believe this is a mistake, please contact conference support for assistance.
    Return to the @if (Auth::check())
        <a href="{{ route('dashboard') }}"
           class="text-waitt-pink-400 hover:text-waitt-pink-600 underline">dashboard</a>
    @else
        <a href="/"
           class="text-waitt-pink-400 hover:text-waitt-pink-600 underline">homepage</a>
    @endif to access the whole website.
@endsection
