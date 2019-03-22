<?php

namespace Blog\Services;

use Blog\Comment;
use Blog\Repositories\CommentRepository;

class CommentService
{
    private $repository;

    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Busca dados do usuário no relacionamento de comentário com usuário.
     *
     * @param mixed $id
     */
    public function usuario($id)
    {
        return $this->repository->usuario($id);
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
}