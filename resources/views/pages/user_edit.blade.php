@extends('layouts.app')

@section('content')
    <h2>Edit</h2>
    {!! Form::open(['action' => ['UserController@update', $user_groups['user']->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $user_groups['user']->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::text('email', $user_groups['user']->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
        </div>
        <div class="form-group">
            {{Form::label('age', 'Age')}}
            <?php
            for($i = 12; $i < 80; $i++)
                $age[] = $i
            ?>
            {!! Form::select('age', $age, $user_groups['user']->id) !!}
        </div>
        <div class="form-group">
            {{ Form::label('OldPassword', 'Old Password') }}
            {{ Form::password('OldPassword', ['class' => 'form-control', 'placeholder' => 'Old Paswoord']) }}
        </div>
        <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Paswoord']) }}
        </div>
        <div class="form-group">
            {{ Form::label('Confirm_Password', 'Confirm Password') }}
            {{ Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Confirm Paswoord']) }}
        </div>
        <div class="form-group">
            <select name="groups[]" class="mdb-select colorful-select dropdown-primary md-form" multiple>
                @foreach($user_groups['groups'] as $group)
                    @if(in_array($group->id, $user_groups['user']->groups->pluck('id')->toArray()))
                        <option value="{{$group->id}}" selected>{{$group->name}}</option>
                    @else
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <br>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection