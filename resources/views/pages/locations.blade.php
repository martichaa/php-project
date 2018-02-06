@extends('layouts.app')

@section('content')
<div class="container">
        <h1 class="text-center" style="color:white;">Locations</h1>
    <div class="jumbotron">
        <table class="table">
            <thead>
                <th>Locations</th>
            </thead>
            @foreach($courses as $course)
            <tbody>      
            <td><h3>{{$course->location}}</h3></td>
            </tbody>
            @endforeach
        </table>
</div>
</div>

@endsection