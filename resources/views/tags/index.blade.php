{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('title', '| Tags')

@section('content')
    
    <div class="row">
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">
                <thead>
                    <tr>    
                        <th>#</th>
                        <th>Name</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <th>{{$tag->id}}</th>
                            <td><a href="/tags/{{$tag->id}}">{{$tag->name}}</a></td>
                            <td><a href="/tags/{{$tag->id}}" class="btn btn-info">View</a></td>
                            <td><a href="/tags/{{$tag->id}}/edit" class="btn btn-success">Edit</a></td>
                            <td>
                                {!!Form::open(['action' => ['TagsController@destroy', $tag->id], 'method' => 'POST'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <form action="{{action('TagsController@store')}}" method="POST">
            <h2 class="mb-4">Create New Tag</h2>
                <div class="form-group">
                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter tag name">
                </div>
                <input type="submit" class="btn btn-sm btn-success" value="Create new tag">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection



