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

    public function postsTag($id)
    {
        return Tag::find($id)->posts;
    }
}