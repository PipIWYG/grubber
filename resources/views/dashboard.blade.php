@extends('grubber')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="globalsearch">
						@include('nav.global.search')
					</div>
					<h2>Dashboard</h2>
				</div>

				<div class="panel-body">
					Welcome to Grubber
				</div>
			</div>
		</div>
	</div>
</div>
@endsection