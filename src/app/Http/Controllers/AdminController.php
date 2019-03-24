<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Services\PostService;
use Blog\Services\TagService;
use Blog\Services\CommentService;
use Blog\Comment;

class AdminController extends Controller
{
    private $postService;
    private $tagService;
    private $commentService;
    /**
    * Cria uma nova instância do controlador.
    */
    public function __construct(PostService $postService, TagService $tagService, CommentService $commentService)
    {
        $this->middleware('auth');

        $this->postService = $postService;
        $this->tagService = $tagService;
        $this->commentService = $commentService;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $quantidade['posts'] = $this->postService->list()->count();
        $quantidade['comments'] = $this->commentService->list()->count();
        $quantidade['tags'] = $this->tagService->list()->count();
        return view('admin.index', ['quantidade' => $quantidade]);
    }
}