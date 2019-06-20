@extends('layouts.app')

@section('content')
    <h2>{{$group->name}}</h2>
    <a class="btn btn-primary" href="/group/{{$group->id}}/edit" role="button">Edit</a>
    <br><br>
    {!!Form::open(['action' => ['GroupController@destroy', $group->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
    <br><br>
    {!! Form::open(['action' => ['GroupController@update', $group->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('exit', ['class'=>'btn btn-danger'])}}
    {!! Form::close() !!}
@endsection