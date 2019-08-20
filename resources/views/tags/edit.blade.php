{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('title', '| Edit Tag')

@section('content')
    <h1>Edit Post</h1>
    {{ Form::open(['action' => ['TagsController@update', $tag->id], 'method' => 'POST', 'data-parsley-validate' => '']) }}
        <div class="form-group">
            {{Form::label('name', 'Tag Name')}}
            {{Form::text('name', $tag->name, ['class' => 'form-control', 'placeholder' => 'Tag name', 'required' => '', 'maxlength' => '255'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection