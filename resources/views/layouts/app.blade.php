<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title  -->
    <title>{{ config('app.name', 'LrvlBlog') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <div class="container py-5">
            @include('inc.messages')
            @yield('content')
        </div>
        
    </div>

        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js')}}"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script>
    </body>
</html>
<!--
//cdn.ckeditor.com/4.4.7/standard/ckeditor.js

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

asset('https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js')

-->
