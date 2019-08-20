{{--@extends('layouts.app')--}}
@extends('layouts.bs4')


@section('title', '| Contact Us')


@section('stylesheets')
    {{-- Html::style('css/parsley.css') --}}
@endsection


@section('content')
    <h1>Contact Us</h1>
    {{ Form::open(['action' => 'PagesController@contact', 'method' => 'POST', 'data-parsley-validate' => '']) }}
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name', 'required' => '', 'maxlength' => '255']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email', 'required' => '', 'maxlength' => '255']) }}
        </div>
        <div class="form-group">
            {{Form::label('message', 'Message')}}
            {{Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'Your message', 'required' => ''])}}
        </div>
        {{ Form::submit('Send Message', ['class' => 'btn btn-primary', 'role' => 'button']) }}
    {{ Form::close() }}
@endsection 



@section('scripts')
    <script src="{{asset('js/custom.js')}}"></script>
    {{-- Html::script('js/parsley.min.js') --}}
@endsection