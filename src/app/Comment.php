<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'description'
    ];

    public function usuario()
    {
        return $this->belongsTo('Blog\User', 'user_id');
    }
}
