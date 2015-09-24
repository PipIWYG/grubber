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
					<h2>Issues</h2>
				</div>

				<div class="panel-body">
					<div class="row fluid-container main-content">
                        <div class="col-md-12">
                            
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Project</th>
                                    <th>Sprint</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($issues as $issue)
                                    <tr>
                                        <td><a href="/issues/{{$issue->id}}">{{$issue->id}}</a></td>
                                        <td><a href="/issues/{{$issue->id}}">{{$issue->title}}</a></td>
                                        <td>{{$issue->statusLabel}}</td>
                                        <td>{{$issue->typeLabel}}</td>
                                        <td>{{$issue->projectName}}</td>
                                        <td>{{App\Sprint::findOrFail($issue->sprint_id)->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <?php echo $issues->render() ?>
                        </div>
                        @include('errors.list')
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
