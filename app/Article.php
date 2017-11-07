<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['author_id', 'title', 'body', 'img'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
