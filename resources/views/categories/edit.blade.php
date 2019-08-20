{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('title', '| Edit Category')

@section('content')
    <h1>Edit Post</h1>
    {{ Form::open(['action' => ['CategoriesController@update', $category->id], 'method' => 'POST', 'data-parsley-validate' => '']) }}
        <div class="form-group">
            {{Form::label('name', 'Category Name')}}
            {{Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Category name', 'required' => '', 'maxlength' => '255'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection