{{--@extends('layouts.app')--}}
@extends('layouts.bs4')

@section('title', '| Categories')

@section('content')
    
    <div class="row">
        <div class="col-md-8">
            <h1>Categories</h1>
            <table class="table">
                <thead>
                    <tr>    
                        <th>#</th>
                        <th>Name</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <th>{{$category->id}}</th>
                            <td>{{$category->name}}</td>
                            <td><a href="/categories/{{$category->id}}/edit" class="btn btn-success">Edit</a></td>
                            <td>
                                {!!Form::open(['action' => ['CategoriesController@destroy', $category->id], 'method' => 'POST'])!!}
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
            <form action="{{action('CategoriesController@store')}}" method="POST">
            <h2 class="mb-4">Create New Category</h2>
                <div class="form-group">
                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter category name">
                </div>
                <input type="submit" class="btn btn-sm btn-success" value="Create new category">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection



