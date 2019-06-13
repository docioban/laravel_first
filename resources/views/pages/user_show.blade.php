@extends('layouts.app')

@section('content')
    <h3>Name: {{$user->name}}</h3>
    <h3>Email: {{$user->email}}</h3>
    <br>
    <h3>Groups:</h3>
    @foreach ($user->groups as $group)
        <a href="/group/{{$group->id}}" class="list-group-item list-group-item-action">{{$group->name}}</a>
    @endforeach
    <br>
    <a type="button" class="btn btn-dark" href="/user/{{$user->id}}}/edit">Edit</a>
    {!!Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
@endsection