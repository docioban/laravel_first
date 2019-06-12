@extends('layouts.app')

@section('content')
    <div class="position-relative container">
        <h1 class="my-4">
            Posts
        </h1>
        <a class="btn btn-dark float-right" href="/posts/create">New post</a>
        <br><br>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="row">
                <div class="col-md-12 block_post">
                    <h3>{{$post->titlu}}</h3>
                    <p>{{$post->body}}</p>
                    <p>Createt at {{$post->created_at}} by {{$post->user_id}}</p>
                    <a class="btn btn-primary" href="/posts/{{$post->id}}">View Project</a>
                </div>
            </div>
        @endforeach
    @endif
    </div>
@endsection