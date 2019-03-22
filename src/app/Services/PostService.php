<?php

namespace Blog\Services;

use Blog\Post;
use Blog\PostTag;
use Blog\Repositories\PostRepository;

class PostService
{
    private $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Busca todos os registros de tags.
     *
     */
    public function list()
    {
        return Post::where('active', 1)->get();
    }

    /**
     * Busca um registro específico no banco.
     *
     * @param mixed $id
     */
    public function get($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Cria um um registro no banco de dados.
     *
     * @param mixed $data
     */
    public function create($data)
    {
        $this->repository->create($data);
    }

    /**
     * Edita o registro no banco de dados.
     *
     * @param mixed $data
     * @param mixed $id
     */
    public function update($data, $id)
    {
        $this->repository->update($data, $id);
    }

     /**
     * Desativa um registro no banco de dados.
     *
     * @param mixed $id
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
    }

    /**
     * Busca dados do usuário no relacionamento.
     *
     * @param mixed $id
     */
    public function postUser($id)
    {
       return $this->repository->postUser($id);
    }

    /**
     * Busca dados do usuário no relacionamento.
     *
     * @param mixed $id
     */
    public function comments($id)
    {
        return $this->repository->comments($id);
    }

    /**
     * Busca dados do usuário no relacionamento.
     *
     * @param mixed $id
     */
    public function tags($id)
    {
        return $this->repository->tags($id);
    }
}