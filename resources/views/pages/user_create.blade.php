@extends('layouts.app')

@section('content')
    <h2>Create new user:</h2>

    {!! Form::open(['action' => 'UserController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
        </div>
        <div class="form-group">
            {{Form::label('age', 'Age')}}
<?php
    for($i = 12; $i < 80; $i++)
        $age[] = $i
?>
            {!! Form::select('age', $age, 'age') !!}
        </div>
        <div class="form-group">
            {{Form::label('password', 'Password')}}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Paswoord']) }}
        </div>
        <div class="form-group">
            {{Form::label('Confirm_Password', 'Confirm Password')}}
            {{ Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Confirm Paswoord']) }}
        </div>
        <div class="form-group">
            <select name="groups[]" class="mdb-select colorful-select dropdown-primary md-form" multiple>
                @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
            </select>
            <br>
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection