{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('content')
<div class="container">
    <h1 class="text-center">{{ Auth::user()->name }}'s Dashboard</h1>
    <div class="jumbotron text-center">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="my-5">
            <a href="/posts" class="btn btn-primary btn-lg my-2">Posts</a>
            <a href="/posts/create" class="btn btn-primary btn-lg my-2">Create Post</a>
            <a href="/categories" class="btn btn-info btn-lg my-2">Categories</a>
            <a href="/tags" class="btn btn-success btn-lg my-2">tags</a>
        </div>       
    </div>
</div>
@endsection


