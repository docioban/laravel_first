@extends('layouts.app')

@section('content')
    <h1>
        Users
    </h1>
    <br><br><br>

    {!! Form::open(['action' => ['UserController@edit', auth()->id()], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
            {!! Form::label('multipleselect[]', 'Multi Select', ['class' => 'col-lg-2 control-label'] )  !!}
            <div class="col-lg-10">
                {!!  Form::select('multipleselect[]', ['honda' => 'Honda', 'toyota' => 'Toyota', 'subaru' => 'Subaru', 'ford' => 'Ford', 'nissan' => 'Nissan'], $selected = null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
            </div>
        </div>

    {{Form::hidden('_method','PUT')}}
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
            </div>
        </div>

    {!! Form::close()  !!}




















{{--    <div class="form-group">--}}
{{--        {!! Form::Label('user', 'User:') !!}--}}
{{--        {!! Form::select('id[]', array_pluck($users, 'name'), 1, ['class' => 'form-control']) !!}--}}
{{--    </div>--}}




{{--    {!! Form::open(['action' => ['UserController@update', $users->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}--}}
{{--        {{Form::select('user[]', $users, array_pluck($users, 'name'), array('class'=>'form-control', 'multiple'=>'multiple','name'=>array_pluck($users, 'name')))}}--}}
{{--        Form::select('user', $users);--}}
{{--        {{Form::hidden('_method','PUT')}}--}}
{{--        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}--}}
{{--    {!! Form::close() !!}--}}

{{--    {!! Form::open(['action' => ['UserController@update', $users[]->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}--}}
{{--    <select class="colorful-select" multiple>--}}
{{--        @foreach($users as $user)--}}
{{--            <option value="{{$user->id}}">{{$user->name}}</option>--}}
{{--        @endforeach--}}
{{--        <option value="" disabled selected>Choose your country</option>--}}
{{--        <option value="1">USA</option>--}}
{{--        <option value="2">Germany</option>--}}
{{--        <option value="3">France</option>--}}
{{--        <option value="3">Poland</option>--}}
{{--        <option value="3">Japan</option>--}}
{{--    </select>--}}
{{--    <label class="mdb-main-label">Label example</label>--}}
{{--    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}--}}
{{--    {!! Form::close() !!}--}}
{{--    --}}{{--    <button class="btn-save btn btn-danger btn-sm">Save</button>--}}
{{--    <a href="/user/{{$user->id}}" class="list-group-item list-group-item-action">sadgfasdg</a>--}}
@endsection