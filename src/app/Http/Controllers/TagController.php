<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Http\Requests\TagRequest;
use Blog\Services\TagService;

class TagController extends Controller
{
    private $tagService;
    /**
    * Cria uma nova instância do controlador.
    */
    public function __construct(TagService $tagService)
    {
        $this->middleware('auth');

        $this->tagService = $tagService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tagService->list();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        try{
            \DB::transaction(function () use ($request) {
                $this->tagService->create($request->all());
            });
            session()->flash('msg', 'Tag cadastrada com sucesso.');

            return redirect()->route('tag.index');
        } catch (\Exception $e) {
            return redirect()->route('tag.create')
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
        $tag = $this->tagService->get($id);
        $posts = $this->tagService->postsTag($id);

        return view('tags.details', compact('tag', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = $this->tagService->get($id);

        return view("tags.create_edit", compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        try{
            \DB::transaction(function () use ($request, $id) {
                $this->tagService->update($request->all(), $id);
            });
                session()->flash('msg', 'Tag editada com sucesso.');

            return redirect()->route('tag.index');
        } catch (\Exception $e) {
            return redirect()->route('tag.create')
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
        $this->tagService->destroy($id);

        $resultado = "sucesso";
        $arr = array('response' => $resultado);
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
}
