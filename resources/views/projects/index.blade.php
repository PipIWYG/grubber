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
					<h2>Projects</h2>
				</div>

				<div class="panel-body">
					<div class="row fluid-container main-content">
                        @if(count($projects) > 0)
                            
                            <div class="fluid-container col-sm-10">
                                @foreach(array_chunk($projects->all(),3) as $row)
                                    <div class="row">
                                        @foreach($row as $project)
                                            <div class="col-sm-4">
                                                @include('projects.list.project-card')
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h2>No projects found</h2>
                            <h3><a href="/projects/create">Create your first project</a></h3>
                        @endif
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
    
@endsection