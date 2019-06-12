@extends('layouts.app')

@section('content')
    <h2>Group Create</h2>
    {!! Form::open(['action' => 'GroupController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
@endsection