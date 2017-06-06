<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
  protected $table = "multimedia";
  protected $fillable = [
    'title','body','user_id','youtube_link'
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }
  public function multimedia_comments(){
      return $this->hasMany(MultimediaComment::class);
  }
}
