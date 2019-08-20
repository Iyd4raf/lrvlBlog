{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('title', '| '.$tag->name.' Tag')

@section('content')

    <p><a href="/tags" class="btn btn-outline-info">Back To Tags</a></p>
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $tag->name}} Tag <small>{{$tag->posts()->count()}} posts</small></h1>
            <hr>
        </div>
        <div class="col-md-4 d-flex justify-content-center">
            <p><a href="/tags/{{$tag->id}}/edit" class="btn btn-success mr-2">Edit</a></p>

            {!!Form::open(['action' => ['TagsController@destroy', $tag->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <h3>Your Blog Posts</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Tags</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tag->posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>
                                @foreach($post->tags as $tag)
                                    <span class="badge badge-secondary">{{$tag->name}}</span>
                                @endforeach
                            </td>
                            <td>    
                                <a href="/posts/{{$post->id}}">View Post</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    


@endsection

