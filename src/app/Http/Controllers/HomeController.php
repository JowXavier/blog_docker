<?php

namespace Blog\Http\Controllers;

use Blog\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where('active',1)->get();
        foreach($posts as $post)
            $post->user = Post::find($post->id)->usuario;

        return view('home', ['posts' => $posts]);
    }
}