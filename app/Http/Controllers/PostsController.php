<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Comment;
use App\Category;
use App\Tag;
use App\User;
use Session;
use Purifier;
use DB;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $posts = $user->posts()->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        $this->validate($request, [
            'title' => 'required|max:255|min:5',
            'category_id' => 'required|integer',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body' => 'required|min:3',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        
        // Handle file upload - don't want user to upload image already exists ***
        if ($request->hasFile('cover_image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename - using php
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get just extension - using laravel
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store ***  don't we need dot?
            $filenameToStore = $filename.'_'.time().'_'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        } else {
            $filenameToStore = 'noimage.jpg';
        }

        //return 123;

        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->category_id = $request->input('category_id');
        $post->slug = $request->input('slug');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filenameToStore;
        $post->visits = 0;

        $post->save();

        //2nd param - override existing associations - don't think this makes difference - creating new post - no existing assocs are there
        $post->tags()->sync($request->input('tags'), false);
        
        
        //Session::flash('success', 'Post Successfully Created');

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        //$comments = Comment::where('post_id', $post->id)->get();

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $cats = [];
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }
        $tags = Tag::all();
        $tagsArr = [];
        foreach ($tags as $tag) {
            $tagsArr[$tag->id] = $tag->name;
        }
        // Check for correct user
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorised Page');
        }

        return view('posts.edit')->with('post', $post)->with('categories', $cats)->with('tags', $tagsArr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if ($request->input('slug') == $post->slug) {
            $this->validate($request, [
                'title' => 'required|min:5|max:255',
                'category_id' => 'required|integer',
                'body' => 'required',
                'cover_image' => 'image|nullable|max:1999'
            ]);
        } else {
            $this->validate($request, [
                'title' => 'required|min:5|max:255',
                'category_id' => 'required|integer',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'body' => 'required',
                'cover_image' => 'image|nullable|max:1999'
            ]);
        }


        // Handle file upload - don't want user to upload image already exists ***
        if ($request->hasFile('cover_image')) {
            
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            
            // Get just filename - using php
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get just extension - using laravel
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store ***
            $filenameToStore = $filename.'_'.time().'_'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }

        // Check for correct user
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorised Page');
        }

        $post->title = $request->input('title');
        $post->category_id = $request->input('category_id');
        $post->slug = $request->input('slug');
        $post->body = $request->input('body');
        $post->visits = 0;
        if ($request->hasFile('cover_image')) { 
            if ($post->cover_image != 'noimage.jpg') {
                Storage::delete('public/cover_images/'.$post->cover_image);
            }
            $post->cover_image = $filenameToStore;
        }
        $post->save();

        if ($request->input('tags')) {
            //true - delete old ones
            $post->tags()->sync($request->input('tags'), true);
        } else {
            //delete all
            $post->tags()->sync([]);
        }

        //$tags = $request->input('tag', []);
        //$post->tags()->sync($tags, true);

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->tags()->detach();

        // Check for correct user
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorised Page');
        }

        // Delete image and we don't want noimage to disappear
        if ($post->cover_image != 'noimage.jpg') {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
