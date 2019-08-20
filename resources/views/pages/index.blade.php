{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('title', '| Home')

@section('content')
    <div class="jumbotron text-center">
        <h1 class="mb-4">{{$title}}</h1>
        @guest
            <p>
                <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
                <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
            </p>
        @else
            <a class="btn btn-primary btn-lg" href="/dashboard" role="button">Dashboard</a>
        @endguest
    </div>
@endsection 



{{--
@if (Auth::user()) 
    <p>{{Auth::user()->name}}</p>
@endif
--}}