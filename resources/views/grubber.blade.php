@extends('grubber-app')

@section('auth-style')
    <link href="{{ asset('/css/grubber.css') }}" rel="stylesheet">
@endsection

@section('body-tag')
	@if(isset($repoInfo) && !empty($repoInfo))
		<body class="env{{ $repoInfo->environment() }}">
	@else
		<body>
	@endif
	@include('nav.global.grubber-main')
@endsection