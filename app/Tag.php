<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts() {
        //following laravel's convention so not specifying other params
        return $this->belongsToMany('App\Post', 'post_tag', 'tag_id', 'post_id');
    }
}
