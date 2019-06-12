@extends('layouts.app')

@section('content')
    Email:
    {!! Form::open(['action' => ['GroupController@update', $val['group']->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <input list="email" name="email" class="col-sm-6">
        <datalist id="email">
            @foreach($val['users'] as $us)
                <option value="{{$us->email}}">{{$us->email}}</option>
            @endforeach
        </datalist>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection