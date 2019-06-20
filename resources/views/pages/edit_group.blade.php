@extends('layouts.app')

@section('content')
    Email:
    {!! Form::open(['action' => ['GroupController@update', $group->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <input list="name" name="name" class="col-sm-6">
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection