@extends('errors::minimal')

@section('code', '401')
@section('message')
    You must be logged in to access this page. <br>
    Please <a class="text-waitt-pink-400 hover:text-waitt-pink-600 underline" href="/login">sign in</a> to your
    account or contact the event administrator if you believe you received this message in error.
@endsection
