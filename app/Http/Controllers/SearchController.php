<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchController extends Controller
{
    public function index(Request $request) {
        $q = $request->input('q', '');
        $posts = Post::where('title', 'LIKE', '%'.$q.'%')
                        ->orderBy('created_at', 'desc')
                        ->orWhere('body', 'LIKE', '%'.$q.'%')
                        ->paginate(10);
        $data = [
            'posts' => $posts,
            'q' => $q
        ];
        return view('search')->with($data);
    }
}
