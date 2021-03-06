<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1, #bs-example-navbar-collapse-2">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/"><img src="/images/grubber_white_118x50.png"/></a>
		</div>

		@unless (Auth::guest())
			<div class="col-sm-3 collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="/">Dashboard</a></li>
					<li class="dropdown">
						<a href="/projects" class="dropdown-toggle" data-toggle="dropdown"
						   role="button" aria-expanded="false">Projects <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/projects') }}">List all Projects</a></li>
							<li><a href="{{ url('/projects/create') }}">Create new Project</a></li>
						</ul>
					</li>
					@if(App\Project::all()->count() > 0)
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"
							   role="button" aria-expanded="false">Issue <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/issues') }}">List</a></li>
								<li><a href="{{ url('/issues/create') }}">Create</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		@endunless

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
			<ul class="nav navbar-nav navbar-right">
				@if (Auth::guest())
					<li><a href="{{ url('/auth/login') }}">Login</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"
						   role="button" aria-expanded="false">

							<img width="24" height="24" src="{{ asset('css/icons/ic_account_circle_grey600_36dp.png') }}" /> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/profile') }}">Profile</a></li>
							<li><a href="{{ url('/settings') }}">Settings</a></li>
							<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>
@if($errors->any())
	<div class="row">
		<div class="pull-right alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			{{$errors->first()}}
		</div>
	</div>
@endif