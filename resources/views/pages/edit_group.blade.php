@extends('layouts.app')

@section('content')
    Email:
    {!! Form::open(['action' => ['GroupController@update', $group->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <input list="name" name="name" class="col-sm-6">
        <br><br>
        <div class="form-group">
            <select name="permissions[]" class="mdb-select colorful-select dropdown-primary md-form" multiple>
                @foreach($permissions as $permission)
                    @if(in_array($permission->id, $group->permissions->pluck('id')->toArray()))
                        <option value="{{$permission->id}}" selected>{{$permission->name}}</option>
                    @else
                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection