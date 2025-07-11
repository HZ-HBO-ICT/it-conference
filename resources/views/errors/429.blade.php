@extends('errors::minimal')

@section('code', '429')
@section('message')
    You have submitted too many requests in a short period. <br>
    Please wait a moment and try again later. If the issue persists, contact support.
@endsection
