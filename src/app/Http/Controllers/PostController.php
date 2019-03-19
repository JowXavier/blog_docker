<?php

namespace Blog\Http\Controllers;

use Blog\Comment;
use Blog\PostTag;
use Blog\Tag;
use Blog\Post;
use Blog\User;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    /*!
     *  RESPONSÁVEL POR SOLICITAR O CARREGAMENTO DE TODOS OS POSTS CADASTRADOS
     * E ENVIA-LOS A VIEW.
     */
    public function index()
    {
        $posts = Post::where('active',1)->get();
        foreach($posts as $post)
            $post->user = Post::find($post->id)->usuario;

      return view("posts.index", ['posts' => $posts]);
    }
    /*!
     *  RESPONSÁVEL POR CARREGAR O FORMULÁRIO DE CADASTRO DE POST.
     */
    public function create()
    {
        $tags = Tag::where('active', 1)->get();
        return view("posts.create_edit", ['tags' => $tags]);
    }
    /*!
     *  RESPONSÁVEL POR SOLICITAR O CARREGAMENTO DOS DADOS DE UM POST
     *  E ENVIA-LOS A VIEW.
     *
     *  $id -> Id do post a ser editado.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::get();
        $postTags = PostTag::where('post_id', $post->id)->get();
        return view("posts.create_edit", ['post' => $post,'tags' => $tags, 'postTags' => $postTags]);
    }
    /*!
     *  RESPONSÁVEL POR VALIDAR OS CAMPOS DO FORMULÁRIO.
     *
     *  $request -> Contém os campos a serem validados.
     */
    public function validar($request)
    {
        $post = Post::where('title', $request->title)->first();

        if(empty($request->title))
            return "Informe o título do post";
        else if(!empty($post) && $request->id != $post->id)
            return "Já existe um post cadastrado com este título.";
        else if(empty($request->description))
            return "Informe a descrição do post";
        else if(empty($request['tag']))
            return "Selecione pelo menos uma tag";
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

        if($resultado == "sucesso")
        {
            $request['user_id'] = Auth::user()->id;
            $post = null;
            if (!isset($request->id))
            {
                $post = Post::create($request->all());
                for ($i = 0; $i < COUNT($request['tag']); $i++)
                    PostTag::create(['post_id' => $post->id, 'tag_id' => $request['tag'][$i]]);
            }
            else
            {
                $post = Post::findOrFail($request->id);
                $post->update($request->all());

                $this->valida_tag($request);
            }
        }
        $arr = array('response' => $resultado);
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    /*!
     *  RESPONSÁVEL POR VERIFICAR QUAIS TAGS DEVEM SER REMOVIDAS DO BANCO E QUAIS DEVEM SER ADICIONADAS.
     * ISSO É NECESSÁRIO AO SE EDITAR UM POST.
     */
    public function valida_tag($request)
    {
        //buscar todos os postTag do post em questão
        $postTags = PostTag::where('post_id', $request->id)->get();

        //adiciona as tags novas se existir
        for ($i = 0; $i < COUNT($request['tag']); $i++)
        {
            $flag = true;
            for ($j = 0; $j < COUNT($postTags); $j++)
            {
                if($request['tag'][$i] == $postTags[$j]->tag_id)
                {
                    $flag = false;
                    break;
                }
            }
            if($flag == true)
                PostTag::create(['post_id' => $request->id, 'tag_id' => $request['tag'][$i]]);
        }

        //remove as tags desmarcadas no formulário.
        for ($i = 0; $i < COUNT($postTags); $i++)
        {
            $flag = true;
            for ($j = 0; $j < COUNT($request['tag']); $j++)
            {
                if($postTags[$i]->tag_id == $request['tag'][$j])
                {
                    $flag = false;
                    break;
                }
            }
            if($flag == true)
                PostTag::destroy($postTags[$i]->id);
        }
    }
    /*!
     *  RESPONSÁVEL POR SOLICITAR A "EXCLUSÃO" DE UM REGISTRO.
     *  $id -> Id do registro a ser "apagado".
     */
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->active = 0;
        $post->update();

        $resultado = "sucesso";
        $arr = array('response' => $resultado);
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    /*!
     *  RESPONSÁVEL POR SOLICITAR O CARREGAMENTO DE UM POST E ENVIAR OS DADOS PARA A VIEW.
     *
     *  $id -> Id do post.
     */
    public function detail($id)
    {
        $post = Post::findOrFail($id);
        $tags = Post::find($id)->tags;
        $comments = Post::find($id)->comments;

        foreach ($comments as $comment)
            $comment->user = User::find($comment->user_id);

        return view("posts.details", ['post' => $post, 'tags' => $tags, 'comments' => $comments]);
    }
    /*!
     *  RESPONSÁVEL POR SOLICITAR O CARREGAMENTO DE UM POST E ENVIAR OS DADOS PARA A VIEW.
     *  ESTE MÉTODO CARREGA A VIEW PARA O USUÁRIO NÃO ADMINISTRADOR.
     *
     *  $id -> Id do post.
     */
    public function detailRegular($id)
    {
        $post = Post::findOrFail($id);
        $post->user = Post::find($id)->usuario;
        $tags = Post::find($id)->tags;
        $comments = Post::find($id)->comments;

        foreach ($comments as $comment)
            $comment->user = User::find($comment->user_id);

        return view("posts.detailsRegular", ['post' => $post, 'tags' => $tags, 'comments' => $comments]);
    }
    /*!
     *  RESPONSÁVEL POR RECEBER DO FORMULÁRIO, O COMENTÁRIO DO USUÁRIO E ENVIA-LO PARA O MODEL.
     *
     *  $request -> Contém o comentário do usuário.
     */
    public function storeComment(Request $request)
    {
        $resultado = $this->validarComentario($request);
        if($resultado == "sucesso")
        {
            $request['user_id'] = Auth::user()->id;
            Comment::create($request->all());
        }
        $arr = array('response' => $resultado);
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    /*!
     *  RESPONSÁVEL POR VALIDAR O COMENTÁRIO INFORMADO PELO USUÁRIO.
     *
     *  $request -> Contém os dados a serem validados.
     */
    public function validarComentario($request)
    {
        if(empty($request->description))
            return "Informe o seu comentário.";
        return "sucesso";
    }
}