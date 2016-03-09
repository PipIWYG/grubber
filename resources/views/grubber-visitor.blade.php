@extends('grubber-app')

@section('auth-style')
    <link href="{{ asset('/css/grubber-visitor.css') }}" rel="stylesheet">
@endsection

@section('body-tag')
	@if(!empty(env('APP_ENV')))
		<body class="env{{ env('APP_ENV') }} visitor">
	@else
		<body class="visitor">
	@endif
@endsection