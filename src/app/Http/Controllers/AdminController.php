<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Tag;
use Blog\Post;
use Blog\Comment;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $quantidade['posts'] = Post::where('active', 1)->count();
        $quantidade['comments'] = Comment::where('active', 1)->count();
        $quantidade['tags'] = Tag::where('active', 1)->count();
        return view('admin.index', ['quantidade' => $quantidade]);
    }
}