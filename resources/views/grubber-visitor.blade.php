@extends('grubber-app')

@section('auth-style')
    <link href="{{ asset('/css/grubber-visitor.css') }}" rel="stylesheet">
@endsection

@section('body-tag')
	@if(isset($repoInfo) && !empty($repoInfo))
		<body class="env{{ $repoInfo->environment() }} visitor">
	@else
		<body class="visitor">
	@endif
@endsection