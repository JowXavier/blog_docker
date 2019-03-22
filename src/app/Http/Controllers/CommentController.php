<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Http\Requests\CommentRequest;
use Blog\Services\CommentService;
use Auth;

class CommentController extends Controller
{
    private $commentService;
    /**
    * Cria uma nova instância do controlador.
    */
    public function __construct(CommentService $commentService)
    {
        $this->middleware('auth');

        $this->commentService = $commentService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        try{
            $request['user_id'] = Auth::user()->id;

            \DB::transaction(function () use ($request) {
                $this->commentService->create($request->all());
            });
            session()->flash('msg', 'Comentário cadastrado com sucesso.');

            return redirect()->route('post.detailRegular', $request->all()['post_id']);
        } catch (\Exception $e) {
            return redirect()->route('post.detailRegular', $request->all()['post_id'])
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

}
