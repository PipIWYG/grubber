@extends('grubber')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h2>Create a project</h2></div>

				<div class="panel-body">
					
                    {!! Form::model($project = new \App\Project, ['url' => 'projects']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Name:') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug:') !!}
                            {!! Form::text('slug', null, ['class' => 'form-control','required']) !!}
                        </div>
                
                        <div class="form-group">
                            {!! Form::label('issue_prefix', 'Issue Prefix:') !!}
                            {!! Form::text('issue_prefix', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                
                        <div class="form-group">
                            {!! Form::label('deadline', 'Deadline:') !!}
                            {!! Form::input('date', 'deadline', null, ['class' => 'form-control']) !!}
                        </div>
                
                        <div class="form-group">
                            {!! Form::submit('Create Project', ['class' => 'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@include('errors.list')
@stop