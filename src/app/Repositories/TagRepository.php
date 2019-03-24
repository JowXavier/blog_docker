<?php

namespace Blog\Repositories;

use Blog\Tag;

class TagRepository
{
    private $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        return $this->model->where('active', 1)->get();
    }

    public function get($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($data)
    {
        $tag = $this->model->create($data);
    }

    public function update($data, $id)
    {
        $tag = $this->model->findOrFail($id);
        $tag->update($data);
    }

    public function destroy($id)
    {
        $tag = $this->model->findOrFail($id);
        $tag->active = 0;
        $tag->update($tag->toArray());
    }
}