<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Http\Requests\PostRequest;
use Blog\Services\PostService;
use Blog\Services\TagService;
use Blog\Services\CommentService;
use Auth;

class PostController extends Controller
{
    private $postService;
    private $commentService;
    private $tagService;
    /**
    * Cria uma nova instância do controlador.
    */
    public function __construct(PostService $postService, CommentService $commentService, TagService $tagService)
    {
        $this->middleware('auth');

        $this->postService = $postService;
        $this->commentService = $commentService;
        $this->tagService = $tagService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->list();
        foreach($posts as $post)
            $post->user = $this->postService->postUser($post->id);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tService = new TagService();
        $tags = $tService->list();
        return view('posts.create_edit', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            $request['user_id'] = Auth::user()->id;

            \DB::transaction(function () use ($request) {
                $this->postService->create($request->all());
            });

            return redirect()->route('post.index');
        } catch (\Exception $e) {
            return redirect()->route('post.create')
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postService->get($id);
        $tags = $this->postService->tags($id);

        $comments = $this->postService->comments($id);

        foreach($comments as $comment)
            $comment->user = $this->commentService->usuario($comment->user_id);

        return view('posts.details', compact('post', 'tags', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postService->get($id);

        $postTags = $this->postService->tags($id);
        $tags = $this->tagService->list();

        return view('posts.create_edit', compact('post', 'tags', 'postTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        try{
            \DB::transaction(function () use ($request, $id) {
                $this->postService->update($request->all(), $id);
            });

            return redirect()->route('post.index');
        }catch(\Exception $e)
        {
            return redirect()->route('post.edit', $id)
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postService->destroy($id);

        $resultado = "sucesso";
        $arr = array('response' => $resultado);
        header('Content-Type: application/json');
        echo json_encode($arr);
    }

    /**
     *  Display the specified resource for regular user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailRegular($id)
    {
        $post = $this->postService->get($id);
        $post->user = $this->postService->postUser($post->id);

        $tags = $this->postService->tags($id);

        $comments = $this->postService->comments($id);

        foreach($comments as $comment)
            $comment->user = $this->commentService->usuario($comment->user_id);

        return view('posts.detailsRegular', compact('post', 'tags', 'comments'));
    }
}
