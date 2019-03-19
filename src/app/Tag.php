<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title',
        'url',
        'active'
        ];

    public function posts()
    {
        return $this->belongsToMany('Blog\Post','post_tags');
    }
}
