<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table      = 'events';
    protected $primaryKey = 'EVN_ID';
    
    protected $fillable = array(
                                'EVN_NOMBRE', 
                                'EVN_FECHA', 
                                'FTO_ID', 
                                'TND_ID', 
                               );
    public $timestamps = false;
    
    
    public function ToFormatos()
    {
        return $this->belongsTo('App\Format','FTO_ID');
    }
    
    public function ToTiendas()
    {
        return $this->belongsTo('App\Store','TND_ID');
    }
    
    
    
    

}
