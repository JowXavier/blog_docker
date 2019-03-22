<?php

namespace Blog\Repositories;

use Blog\Comment;

class CommentRepository
{

    private $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function usuario($id)
    {
        return $this->model->find($id)->usuario;
    }

    public function create($data)
    {
        $this->model->create($data);
    }
}