<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List extends Model
{
    
    protected $table      = 'lists';
    protected $primaryKey = 'LST_ID';
    
    protected $fillable = array(
                                'LST_CANTIDAD',
                                'CRT_ID',
                                'EVM_ID',
                                'LST_NOMBRE_CARTA',
                                'TCR_ID',
                               );
    public $timestamps = false;
    
        
    public function ToTipoCarta(){
        return $this->belongsTo('App\CardType','TCR_ID' );
    }
    
    
    public function ToCartas(){
        return $this->belongsTo('App\Card','CRT_ID' );
    }
}
