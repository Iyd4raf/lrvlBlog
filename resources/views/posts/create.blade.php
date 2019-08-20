{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('title', '| Create Post')

@section('content')
    <h1>Create Post</h1>
    <!-- if file field, enctype attribute need -->
    {{ Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '']) }}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title', 'required' => '', 'maxlength' => '255', 'minlength' => '5'])}}
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" name="category_id" id="category_id">
                @foreach($categories as $category) 
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <select class="form-control select2-multi" name="tags[]" id="tags" multiple="multiple">
                @foreach($tags as $tag) 
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{Form::label('slug', 'Slug')}}
            {{Form::text('slug', '', ['class' => 'form-control', 'placeholder' => 'Slug', 'required' => '', 'maxlength' => '255', 'minlength' => '5'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body text', 'required' => '', 'minlength' => '3'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection


@section('scripts')
    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@endsection