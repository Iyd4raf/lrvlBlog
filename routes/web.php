<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
Route::get('/', function () {
    return view('welcome');
});


Route::get('/about', function() {
    return view('pages.about');
});

Route::get('/hello', function () {
    return 'Hello World';
});
*/

/*
Route::get('/users/{id}/{name}', function($id, $name) {
    return 'This is user ' . $name . ' with an id of ' . $id;
});
*/



Route::get('/', 'PagesController@index');

Route::get('/blog/{slug}', ['as' => 'blog.post', 'uses' => 'BlogController@post'])
    ->where('slug', '[\w\d\-\_]+');

Route::get('blog', 'BlogController@index');

Route::get('about', 'PagesController@about');

Route::get('/services', 'PagesController@services');

Route::get('/contact', 'PagesController@contact');
Route::post('/contact', 'PagesController@contact');

Route::resource('posts', 'PostsController');
Route::resource('categories', 'CategoriesController', ['except' => ['create']]);
Route::resource('tags', 'TagsController');
Route::resource('comments', 'CommentsController');

Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);


Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::post('/search', 'SearchController@index');

//route::post('/comments/{post_id}', 'CommentsController@store');

//Route::get('/send/email', 'HomeController@mail');

