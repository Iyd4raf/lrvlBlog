@extends('layouts.bs4')

@section('title', '| Edit Comment')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Edit Comment</h1>
			
			{{ Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'POST', 'data-parsley-validate' => '']) }}
			
            <div class="form-group">
                {{ Form::label('name', 'Name:') }}
				{{ Form::text('name', null, ['class' => 'form-control', 'disabled' => '']) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', 'Email:') }}
				{{ Form::text('email', null, ['class' => 'form-control', 'disabled' => '']) }}
            </div>
            <div class="form-group">
                {{ Form::label('comment', 'Comment:') }}
				{{ Form::textarea('comment', null, ['class' => 'form-control']) }}
            </div>
            
            {{ Form::hidden('_method', 'PUT') }}

			{{ Form::submit('Update Comment', ['class' => 'btn btn-block btn-success mt-3']) }}
			
			{{ Form::close() }}
		</div>
	</div>

@endsection