<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // MASS ASSIGN
    protected $fillable = [
        'title',
        'body',
        'path_img',
        'slug'
    ];
}
