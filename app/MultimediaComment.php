<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultimediaComment extends Model
{
  protected $table = 'multimedia_comments';
  protected $fillable = [
    'title', 'body', 'user_id'
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function multimedia(){
    return $this->belongsTo(Multimedia::class);
  }}
