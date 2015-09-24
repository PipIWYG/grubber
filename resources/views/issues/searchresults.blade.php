@extends('grubber')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Issue Search</h2>
                    </div>
    
                    <div class="panel-body">
                        <div class="row fluid-container main-content">
                            <div class="container-fluid col-md-12">
                                <span class="grey">Search Results for: </span> @if($query) {{$query}} @endif
                                <hr/>
                                @if($issues->count() > 0)
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Type</th>
                                            <th>Project</th>
                                            <th>Sprint</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($issues as $issue)
                                            <tr>
                                                <td><a href="/isssues/{{$issue->id}}">{{$issue->id}}</a></td>
                                                <td><a href="/issues/{{$issue->id}}">{{$issue->title}}</a></td>
                                                <td>{{$issue->statusLabel}}</td>
                                                <td>{{$issue->typeLabel}}</td>
                                                <td>{{$issue->projectName}}</td>
                                                <td>{{App\Sprint::findOrFail($issue->sprint_id)->name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h2>No Search Results found for: @if($query) {{$query}} @endif</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
@stop