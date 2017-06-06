<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='posts';
    protected $fillable = [
      'title', 'body'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post_comments(){
        return $this->hasMany(PostComment::class);
    }
    public function image(){
        return $this->hasMany(PostImage::class)->select('image');
    }
}
