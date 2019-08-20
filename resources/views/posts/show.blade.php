{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('title', '| '.$post->title)

@section('content')
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <div class="d-flex mb-4">
                <a href="/posts/{{$post->id}}/edit" class="btn btn-success mr-2">Edit</a>

                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'form-inline'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
            </div>
        @endif
    @endif
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-8 post">
            <h1>{{$post->title}}</h1>
            <p>{{date('F j Y', strtotime($post->created_at))}} by {{$post->user->name}}</p>
            <p>
                <span class="badge badge-info">{{$post->category->name}}</span>
                |
                @if (count($post->tags) > 0)
                    @foreach($post->tags as $tag)
                        <span class="badge badge-success">{{$tag->name}}</span>
                    @endforeach
                @endif
            </p>
            <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%;" class="mb-5">
            <div>
                {!!$post->body!!}
            </div>
            
            <hr>

            <div id="backend-comments" class="mt-5">
                <h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post->comments as $comment)
                        <tr>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->comment }}</td>
                            <td>
                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary">Edit</a>
                                <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <hr>
            
            <div class="comments-form-container my-5">
                <h3>Add A Comment</h3>
                <form action="{{ action('CommentsController@store') }}" method="POST" class="comments-form" data-parsley-validate="">
                    <div class="form-group">
                        <label for="formCommentName">Name</label>
                        <input type="text" name="name" class="form-control" id="formCommentName" placeholder="Name" required maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="formCommentEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="formCommentEmail" placeholder="name@example.com" required maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="formCommentText">Comment</label>
                        <textarea class="form-control" name="comment" id="formCommentText" rows="3" required minlength="5" maxlength="2000"></textarea>
                    </div>
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
            <div class="comments-container">
                @if (count($post->comments) > 0) 
                    <h3 class="mb-5">{{$post->comments()->count()}} Comments</h3>
                    @foreach($post->comments as $comment)
                        <div class="border my-4">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="comment" id="comment-{{$comment->id}}">
                                        <div class="author-info">
                                            <img src="" class="author-image">
                                            <div class="author-name">
                                                <h6>{{$comment->name}} says:</h6>
                                                <small class="author-time">{{date('F nS, Y - g: iA', strtotime($comment->created_at))}}</small>
                                            </div>
                                        </div>
                                        <div class="comment-content">
                                            <p>{{$comment->comment}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection