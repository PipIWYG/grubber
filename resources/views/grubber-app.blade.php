
@section('footer')
	<div class="appRepoInfo">
		@if(isset($repoInfo) && !empty($repoInfo))
			{{ $repoInfo->formatOutput() }}
		@else
			Warning: No Repo Info Found
		@endif
	</div>
@endsection

@section('favicon')
	@if (env('APP_ENV') == "local")
		<link rel="apple-touch-icon" sizes="57x57" href="/favico-dev-apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/favico-dev-apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/favico-dev-apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/favico-dev-apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/favico-dev-apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/favico-dev-apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/favico-dev-apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/favico-dev-apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/favico-dev-apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="/favico-dev-favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/favico-dev-android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="/favico-dev-favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favico-dev-favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/favico-dev-manifest.json">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="/favico-dev-mstile-144x144.png">
		<meta name="theme-color" content="#ffffff">
	@elseif (env('APP_ENV') == "staging" || env('APP_ENV') == "test")
		<link rel="apple-touch-icon" sizes="57x57" href="/favico-acpt-apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/favico-acpt-apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/favico-acpt-apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/favico-acpt-apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/favico-acpt-apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/favico-acpt-apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/favico-acpt-apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/favico-acpt-apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/favico-acpt-apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="/favico-acpt-favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/favico-acpt-android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="/favico-acpt-favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favico-acpt-favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/favico-acpt-manifest.json">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="/favico-acpt-mstile-144x144.png">
		<meta name="theme-color" content="#ffffff">
	@else
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="/mstile-144x144.png">
		<meta name="theme-color" content="#ffffff">
	@endif
	
@endsection

@section('meta-tags')
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
@endsection

@section('html-document-title')
    <title>{{env('APP_NAME')}}</title>
@endsection

@section('body-tag')
    <body>
@endsection

@section('html-head')
    @yield('meta-tags')
    @yield('html-document-title')
	@yield('favicon')
	
	<link href='//fonts.googleapis.com/css?family=Archivo+Narrow' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
	@yield('auth-style')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="{{ asset('/js/html5shiv-3.7.2.js') }}"></script>
	<script src="{{ asset('/js/respond-1.4.2.js') }}"></script>
	<![endif]-->
@endsection

@section('html-body')
    <div class="container-fluid">
        @yield('header')
    </div>
    <div class="container-fluid">
        @yield('notifications')
    </div>
    <div id="ContentContainer" class="container-fluid">
        @yield('content')
    </div>
    <div class="container-fluid">
        <div class="footer">
            @yield('footer')
        </div>
    </div>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    @yield('js-includes')
    <script src="/js/main.js"></script>
    @yield('beforebodyend')
@endsection

@section('document')
<!DOCTYPE html>
<html>
    <head>
    @yield('html-head')
    </head>
    @yield('body-tag')
    @yield('html-body')
    </body>
</html>
@show
