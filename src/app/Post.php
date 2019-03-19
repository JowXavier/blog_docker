<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'active',
        'user_id'
    ];

    public function usuario()
    {
        return $this->belongsTo('Blog\User','user_id');
    }

    public function tags()
    {
        return $this->belongsToMany('Blog\Tag','post_tags');
    }

    public function comments()
    {
        return $this->hasMany('Blog\Comment');
    }
}