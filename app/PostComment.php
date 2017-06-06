<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
  protected $table = 'post_comments';
  protected $fillable = [
    'title', 'body', 'user_id'
  ];

  public function user(){
      return $this->belongsTo(User::class);
  }

  public function post(){
    return $this->belongsTo(Post::class);
  }
}
