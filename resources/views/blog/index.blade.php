{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('title', '| Blog')

@section('content')
    <h1>Posts</h1>
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-8 posts">
            @if (count($posts) > 0)
                @foreach ($posts as $post)
                    <div class="mb-4 py-4">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-4 mb-sm-3"><a href="/blog/{{$post->slug}}">{{$post->title}}</a></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%;">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <p class="mt-4 mt-sm-0">{{ substr(strip_tags($post->body), 0, 200) }}{{ strlen(strip_tags($post->body)) > 200 ? "..." : "" }}</p>
                                <p><small>{{$post->user->name}} | {{date('F j Y', strtotime($post->created_at))}}</small></p>
                                <p><a href="/blog/{{$post->slug}}" class="btn btn-primary btn-sm">Read More</a></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <!-- pagination -->
                {{$posts->links()}}
            @else
                <p>No posts found</p>
            @endif
        </div>
        <div class="col-8 col-sm-8 offset-2 offset-lg-0 col-lg-4 aside">
            @include('inc.blog_sidebar')
        </div>
    </div>
@endsection



