<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use DB;

class BlogController extends Controller
{

    public function index() {
        //return Post::all();
        //$posts = Post::all();
        //return $post = Post::where('title', 'Post Two')->get();
        //$posts = DB::select('SELECT * FROM posts ORDER BY title DESC');
        //$posts = Post::orderBy('title', 'desc')->take(1)->get();
        //$posts = Post::orderBy('title', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $popular_posts = Post::orderBy('visits', 'desc')->take(10)->get();
        $data = [
            'posts' => $posts,
            'popular_posts' => $popular_posts
        ];
        return view('blog.index')->with($data);
    }

    public function post($slug) {
        $post = Post::where('slug', $slug)->first();
        $comments = Comment::where('post_id', $post->id)->get();
        $popular_posts = Post::orderBy('visits', 'desc')->take(10)->get();
        $data = [
            'post' => $post,
            'comments' => $comments,
            'popular_posts' => $popular_posts
        ];
        return view('blog.post')->with($data);
    }
}
