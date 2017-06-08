<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $table      = 'formats';
    protected $primaryKey = 'FTO_ID';
    
    protected $fillable = array(
                                'FTO_NOMBRE', 
                               );
    public $timestamps = false;
    
    public function formatoMazos()
    {
        return $this->hasMany('App\Deck', 'FTO_ID');
    }
    
    public function ToEventos(){
        return $this->hasMany('App\Event', 'FTO_ID', 'FTO_ID');
    }
}
