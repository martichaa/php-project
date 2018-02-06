@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/courses/create" class="btn btn-primary">Submit New Course</a>
                    <br>
                    <hr>
                    @if(count($courses) > 0)
                    <h3>Courses you have submitted</h3>
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{$course->CourseName}}</td>
                            <td><a href="/courses/{{$course->id}}/edit" class="btn btn-default">Edit</a></td>
                            <td>{!!Form::open(['action' => ['CoursesController@destroy', $course->id], 'method' => 'POST'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}</td>
                        </tr>
                    @endforeach
                </table>
                @else
                You have not submitted any courses.
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
