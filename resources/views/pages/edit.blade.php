@extends('layouts.app')

@section('content')
<h1>Edit course</h1><a href="{{ URL::to('courses') }}"><button type="button" class="btn btn-primary">Go Back</button></a>  
<hr>
    {!! Form::open(['action' => ['CoursesController@update', $course->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('CourseName', 'Name of the course:')}}
            {{Form::text('CourseName', $course->CourseName, ['class' => 'form-control', 'placeholder' => 'Course'])}}
        </div>
        <div class="form-group">
            {{Form::label('date', 'Start of the course (YYYY-MM-DD):')}}
            {{Form::text('date', $course->date, ['class' => 'form-control', 'placeholder' => 'Date'])}}
        </div>
        <div class="form-group">
            {{Form::label('duration', 'Duration of the course:')}}
            {{Form::text('duration', $course->duration, ['class' => 'form-control', 'placeholder' => 'Duration'])}}
        </div>
        <div class="form-group">
            {{Form::label('teacher', 'Full name of the teacher:')}}
            {{Form::text('teacher', $course->teacher, ['class' => 'form-control', 'placeholder' => 'Teacher'])}}
        </div>
        <div class="form-group">
            {{Form::label('organization', 'Name of the organization:')}}
            {{Form::text('organization', $course->organization, ['class' => 'form-control', 'placeholder' => 'Organization'])}}
        </div>
        <div class="form-group">
            {{Form::label('location', 'Country where the course is going to be presented:')}}
            {{Form::text('location', $course->location, ['class' => 'form-control', 'placeholder' => 'Country'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        <div class="form-group">
                <b>Add a cover image:</b>
                {{Form::file('cover_image')}}
            </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection