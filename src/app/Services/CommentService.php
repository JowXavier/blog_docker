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
     * Cria um um registro no banco de dados.
     *
     * @param mixed $data
     */
    public function create($data)
    {
        $this->repository->create($data);
    }

    /**
     * Busca todos os registros de tags.
     *
     */
    public function list()
    {
        return $this->repository->list();
    }

}