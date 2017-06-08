<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeckEvent extends Model
{
    //
    protected $table      = 'deck_events';
    protected $primaryKey = 'EVM_ID';
    
    protected $fillable = array(
                                'EVN_ID',
                                'MAZ_ID',
                                'EVN_ID',
                                'JGD_ID',
                                'EVM_NOMBRE_MAZO',
                                'EVM_POSICION',
                               );
    public $timestamps = false;
    
    
    public function ToMazos()
    {
        return $this->belongsTo('App\Deck','MAZ_ID');
    }
    
    public function ToEventos()
    {
        return $this->belongsTo('App\Event','EVN_ID');
    }
    
    public function ToJugadores(){
        return $this->belongsTo('App\Player','JGD_ID');
    }
    
}
