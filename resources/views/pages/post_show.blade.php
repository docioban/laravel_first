@extends('layouts.app')

@section('content')
    <h1>{{$post->titlu}}</h1>
    <h3>{{$post->body}}</h3>
    <p>Created at {{$post->created_at}}</p>
    <a class="btn btn-primary" href="/posts/{{$post->id}}/edit">Edit</a>
    <br><br>
    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
@endsection