<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        //return 'index';
        $title = 'Welcome to lrvlBlog';
        if (auth()->user()) {
            $title .= ' '.auth()->user()->name;
        }
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }

    public function about() {
        $title = 'About Us';
        return view('pages.about')->with('title', $title);
    }
    

    public function services() {
        $data = [
            'title' => 'Services',
            'services' => ['Cellular Detox', 'Weight Loss', 'Gut Healing']
        ];
        return view('pages.services')->with($data);
    }


    public function contact(Request $request) {

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'message' => 'required'
            ]);
        }

        return view('pages.contact');
    }


}
