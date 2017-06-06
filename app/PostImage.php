<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = "post_images";
    protected $fillable = [
      'image','user_id','post_id'
    ];

    public function setImageAttribute($image)
    {
        $this->attributes['image'] = Carbon::now()->second.Carbon::now()->minute.Carbon::now()->hour.$image->getClientOriginalName();

        $name = Carbon::now()->second.Carbon::now()->minute.Carbon::now()->hour.$image->getClientOriginalName();

        \Storage::disk('local')->put($name, \File::get($image));
    }


    public function imagePost(){
        return $this->belongsTo(Post::class, 'post_id');
    }
}
