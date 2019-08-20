{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('title', '| Edit Post')

@section('content')
    <h1>Edit Post</h1>
    {{ Form::model($post, ['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '']) }}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => '', 'maxlength' => '255'])}}
        </div>
        <div class="form-group">
            {{ Form::label('category_id', "Category") }}
            {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('tags', "Tags") }}
            {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}
        </div>
        <div class="form-group">
            {{Form::label('slug', 'Slug')}}
            {{Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug', 'required' => '', 'maxlength' => '255', 'minlength' => '5'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', null, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body text', 'required' => '', 'minlength' => '3'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection


@section('scripts')
    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@endsection