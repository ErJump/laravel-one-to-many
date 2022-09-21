<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'author',
        'title',
        'post_content',
        'post_image',
        'post_date',
        'slug'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
