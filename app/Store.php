<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table      = 'stores';
    protected $primaryKey = 'TND_ID';
    
    protected $fillable = array(
                                'TND_NOMBRE', 
                                'TND_PROPIETARIO', 
                                'TND_DIRECCION', 
                               );
    public $timestamps = false;
 
    public function ToEventos(){
        return $this->hasMany('App\Event', 'TND_ID', 'TND_ID');
    }
}
