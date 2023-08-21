@extends('errors::minimal')

@section('code', '403')
@section('message')
    Whoa there, Tech Explorer! This path is reserved for authorized eyes only.<br>
    Our IT Conference's content vault is securely locked.<br>
    Return to the @if (Auth::check()) <a href="{{ route('announcements') }}" class="text-yellow-300 hover:text-yellow-500 hover:border-b-2 hover:border-yellow-500 transition-all">dashboard</a> @else <a href="/" class="text-yellow-300 hover:text-yellow-500 hover:border-b-2 hover:border-yellow-500 transition-all">homepage</a> @endif to access the whole website.
@endsection
