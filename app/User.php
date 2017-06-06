<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany(Post::class,'user_id');
    }

    public function multimedia(){
        return $this->hasMany(Multimedia::class,'user_id');
    }

    public function post_comments(){
        return $this->hasMany(PostComment::class,'user_id');
    }
    public function multimedia_comments(){
        return $this->hasMany(MultimediaComment::class,'user_id');
    }
}
