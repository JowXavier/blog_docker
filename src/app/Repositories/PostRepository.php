<?php

namespace Blog\Repositories;

use Blog\Post;
use Blog\PostTag;

class PostRepository
{

    private $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        $post = $this->model->create($data);

        if(!isset($data['tag']))
            return true;

        foreach($data['tag'] as $tag)
            $post->tags()->attach($tag);
    }

    public function update($data, $id)
    {
        $post = $this->model->findOrFail($id);
        $post->update($data);

        if(!isset($data['tag']))
            return true;

        $post->tags()->sync($data['tag']);
    }

    public function destroy($id)
    {
        $post = $this->model->findOrFail($id);
        $post->active = 0;
        $post->update($post->toArray());
    }

    public function postUser($id)
    {
        return $this->model->find($id)->usuario;
    }

    public function comments($id)
    {
        return $this->model->find($id)->comments;
    }

    public function tags($id)
    {
        return $this->model->find($id)->tags;
    }
}