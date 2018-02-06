@extends('layouts.app')

@section('content')
<h1 class="text-center" style="color:white;">Available Courses</h1>
<hr>

    @if(count($courses) > 0)
    @foreach($courses as $course)
    


        <div class="panel panel-default">
                <div class="panel-heading">{{$course->CourseName}}</div>
                <div class="panel-body">
                    <div class="row">
                            <div class="col-sm-8" style="font-size:20px;">
                                    <p>Date: {{$course->date}} </p>
                                    <p>Duration: {{$course->duration}} Minutes</p>
                                    <p>Teacher: {{$course->teacher}} </p>
                                    <p>Organization: {{$course->organization}}</p>
                                    <p>Location: {{$course->location}}</p>
                                    @if(!Auth::guest())
                                    @if(Auth::user()->id == $course->user_id)
                                <a href="courses/{{$course->id}}/edit"><button type="button" class="btn btn-success">Edit</button></a>
                                                    {!!Form::open(['action' => ['CoursesController@destroy', $course->id], 'method' => 'POST'])!!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                    {!!Form::close()!!}
                                
                                    @endif
                                @endif
                            </div>
                            <div class="col-sm-4">
                                    <img style="width:300px; height:300px;" src="/storage/cover_images/{{$course->cover_image}}">
                            </div>
                    </div>
                </div>
           <div class="panel-footer">
                <p>Submitted by: <b>{{$course->user->name}}</b></p>
           </div>
            </div>
            @endforeach
    @else
        <b><p style="color:white;">No courses found.</p></b>
    @endif

      <a href="{{ URL::to('courses/create') }}"><button type="button" class="btn btn-primary">Submit a course</button></a>  
@endsection

