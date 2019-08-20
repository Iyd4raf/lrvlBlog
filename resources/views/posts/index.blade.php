{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('title', '| Blog')

@section('content')
    <h1 class="text-center mb-4">Posts</h1>
    <div class="row">
        <div class="col-12 col-sm-12">
            <a href="/posts/create" class="btn btn-primary mb-5">Create Post</a>
            @if (count($posts) > 0)
                <table class="table table-striped">
                    <tr>
                        <th>Title</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($posts as $post)
                        <tr>
                            <td><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                            <td><a href="/posts/{{$post->id}}" class="btn btn-info">View</a></td>
                            <td><a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</a></td>
                            <td>
                                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>No posts found</p>
            @endif
        </div>
    </div>
@endsection

