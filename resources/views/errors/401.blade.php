@extends('errors::minimal')

@section('code', '401')
@section('message')
    Access Denied! This page is exclusive to authorized attendees.<br>
    Return to the <a href="/" class="text-yellow-300 hover:text-yellow-500 hover:border-b-2 hover:border-yellow-500 transition-all">conference home page</a> to find your path to knowledge and innovation,<br>
    or <a href="{{ route('login') }}" class="text-yellow-300 hover:text-yellow-500 hover:border-b-2 hover:border-yellow-500 transition-all">ensure</a> you've obtained the right credentials for entry.
@endsection
