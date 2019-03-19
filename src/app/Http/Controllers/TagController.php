<?php

namespace Blog\Http\Controllers;

use Blog\Tag;
use Illuminate\Http\Request;

/*!
 *  ESTA CLASSE TEM POR RESPONSABILIDADE CONTROLAR TODAS AS AÇÕES REFERENTE AS TAGS.
 * */

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*!
     *  RESPONSÁVEL POR SOLICITAR O CARREGAMENTO DE TODAS AS TAGS CADASTRADAS
     * E ENVIA-LAS A VIEW.
     */
    public function index()
    {
        $tags = Tag::where('active', 1)->get();
        return view("tags.index", ['tags' => $tags]);
    }
    /*!
     *  RESPONSÁVEL POR CARREGAR O FORMULÁRIO DE CADASTRO DE TAG.
     */
    public function create()
    {
       return view("tags.create_edit");
    }
    /*!
     *  RESPONSÁVEL POR SOLICITAR O CARREGAMENTO DOS DADOS DE UMA TAG
     *  E ENVIA-LOS A VIEW.
     *
     *  $id -> Id da tag a ser editada.
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view("tags.create_edit", ['tag' => $tag]);
    }
    /*!
     *  RESPONSÁVEL POR VALIDAR OS CAMPOS DO FORMULÁRIO.
     *
     *  $request -> Contém os campos a serem validados.
     */
    public function validar($request)
    {
        $tagTitle = Tag::where('title', $request->title)->first();
        $tagUrl = Tag::where('url', $request->url)->first();

        if(empty($request->title))
            return "Informe o título da tag";
        else if(!empty($tagTitle) && $request->id != $tagTitle->id)
            return "Já existe uma tag cadastrada com este título";
        else if(empty($request->url))
            return "Informe a url da tag";
        else if(!empty($tagUrl) && $request->id != $tagUrl->id)
            return "Já existe uma tag cadastrada com esta Url";
        return "sucesso";
    }
    /*!
     *  RESPONSÁVEL POR COLETAR OS DADOS ENVIADOS PELO FORMULÁRIO.
     *
     * $request -> Contém os campos enviados pelo formulário.
     */
    public function store(Request $request)
    {
        $resultado = $this->validar($request);

        /*$validacao = $request->validate([
            'title' => 'required',
            'url' => 'required',
        ]);*/

        if($resultado == "sucesso")
        {
            if (!isset($request->id))
                Tag::create($request->all());
            else {
                $tag = Tag::findOrFail($request->id);
                $tag->update($request->all());
            }
        }
        $arr = array('response' => $resultado);
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    /*!
     *  RESPONSÁVEL POR SOLICITAR A "EXCLUSÃO" DE UM REGISTRO.
     *  $id -> Id do registro a ser "apagado".
     */
    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->active = 0;
        $tag->update();

        $resultado = "sucesso";
        $arr = array('response' => $resultado);
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    /*!
     *  RESPONSÁVEL POR SOLICITAR O CARREGAMENTO DE UMA TAG E DOS POSTS
     *  RELACIONADOS A ELA E ENVIAR OS DADOS PARA A VIEW.
     *
     *  $id -> Id da tag.
     */
    public function detail($id)
    {
        $tag = Tag::findOrFail($id);
        $posts = Tag::find($id)->posts;
        return view("tags.details", ['tag' => $tag, 'posts' => $posts]);
    }
}