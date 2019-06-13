@extends('layouts.app')

@section('content')
    <h1>
        Users
    </h1>
    <br><br><br>
    <a type="button" class="btn btn-dark float-right" href="/user/create">New user</a>
    <br><br><br>
    <div class="list-group">
        @foreach($users as $user)
            <a href="user/{{$user->id}}" class="list-group-item list-group-item-action">{{$user->name}}</a>
        @endforeach
    </div>
@endsection