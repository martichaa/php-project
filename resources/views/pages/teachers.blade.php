@extends('layouts.app')

@section('content')
<div class="container">
        <h1 class="text-center" style="color:white;">Teachers</h1>
    <div class="jumbotron">
        <table class="table">
            <thead>
                <th>Teachers</th>
            </thead>
            @foreach($courses as $course)
            <tbody>      
            <td><h3>{{$course->teacher}}</h3></td>
            </tbody>
            @endforeach
        </table>
    </div>
</div>

@endsection