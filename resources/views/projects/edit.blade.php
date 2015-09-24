@extends('grubber')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h2>Edit Project: {!! $project->name !!}</h2></div>

				<div class="panel-body">
                
                    <div class="container-fluid col-md-12"> 
                        
                        {!! Form::model($project, ['method' =>'PATCH','action' => ['ProjectsController@update',$project->id]]) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Name:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                <input name="project_id" type="hidden" value="{{$project->id}}">
                            </div>
                    
                            <div class="form-group">
                                {!! Form::label('slug', 'Slug:') !!}
                                {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                            </div>
                    
                            <div class="form-group">
                                {!! Form::label('issue_prefix', 'Issue Prefix:') !!}
                                {!! Form::text('issue_prefix', null, ['class' => 'form-control']) !!}
                            </div>
                    
                            <div class="form-group">
                                {!! Form::label('deadline', 'Deadline:') !!}
                                {!! Form::input('date', 'deadline', $deadline, ['class' => 'form-control']) !!}
                            </div>
                    
                            <div class="form-group">
                                {!! Form::submit('Update Project', ['class' => 'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                    @include('errors.list')
                </div>
			</div>
		</div>
	</div>
</div>
@endsection