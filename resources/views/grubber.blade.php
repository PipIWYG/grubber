@extends('grubber-app')

@section('auth-style')
    <link href="{{ asset('/css/grubber.css') }}" rel="stylesheet">
@endsection

@section('body-tag')
    <body>
	@include('nav.global.grubber-main')
@endsection