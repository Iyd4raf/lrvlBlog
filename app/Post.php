<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name
    protected $table = 'posts';
    // Primary Key
    public $primary_key = 'id';
    // Timestamps - true by default
    public $timestamps = true;

    public function user() {
        // Saying Post has relationship with user and belongs to a user (one post)
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function tags() {
        //following laravel's convention so not specifying other params
        return $this->belongsToMany('App\Tag');
    }

}
