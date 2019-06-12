@extends('layouts.app')

@section('content')
    <h2>{{$group->name}}</h2>
    @if($group['users'])
        <ul class="list-group list-group-flush">
            @foreach($group->users as $us)
                <li class="list-group-item">Name: {{$us->name}} Email: {{$us->email}}</li>
            @endforeach
        </ul>
    @endif
    <br><br>
    <a class="btn btn-primary" href="/group/{{$group->id}}/edit" role="button">AddPerson</a>
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