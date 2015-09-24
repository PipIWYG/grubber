@extends('grubber')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>Edit Issue: {!! $issue->title !!} </h2>
				</div>

				<div class="panel-body">
					<div class="row fluid-container main-content">
                        <div class="container-fluid col-md-10">
                            
                            {!! Form::model($issue, ['method' =>'PATCH','action' => ['IssuesController@update',$issue->id]]) !!}
                            <div class="form-group">
                                {!! Form::label('title', 'Title:') !!}
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        
                            <div class="form-group">
                                {!! Form::label('description', 'Description:') !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                            </div>
                        
                            <div class="form-group">
                                {!! Form::label('project_id', 'Project:') !!}
                                {!! Form::select('project_id', $projectNames, null, ['class' => 'form-control']) !!}
                            </div>
                        
                            <div class="form-group">
                                {!! Form::label('deadline', 'Deadline:') !!}
                                {!! Form::input('date', 'deadline', $deadline, ['class' => 'form-control']) !!}
                            </div>
                        
                            <div class="form-group">
                                {!! Form::label('status_id', 'Status:') !!}
                                {!! Form::select('status_id', $issueStatusLabels, null, ['class' => 'form-control']) !!}
                            </div>
                        
                            <div class="form-group">
                                {!! Form::label('type_id', 'Type:') !!}
                                {!! Form::select('type_id', $issueTypeLabels, null, ['class' => 'form-control']) !!}
                            </div>
                        
                            <div class="form-group">
                                {!! Form::submit('Update Issue', ['class' => 'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                        @include('errors.list')
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
    

@include('errors.list')
@endsection