@extends('layouts.app')

@section('content')
    <h2>Groups</h2>
    <a type="button" class="btn btn-dark float-right" href="/group/create">New group</a>
    <br><br><br>
    @if (count($user->groups) > 0)
        <div class="list-group">
        @foreach($user->groups as $group)
            <a href="/group/{{$group->id}}" class="list-group-item list-group-item-action">{{$group->name}}</a>
        @endforeach
        </div>
    @endif
@endsection