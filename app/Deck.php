<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    protected $table      = 'decks';
    protected $primaryKey = 'MAZ_ID';
    
    protected $fillable = array(
                                'MAZ_NOMBRE',
                                'FTO_ID',
                               );
    public $timestamps = false;
    
    
    public function formato()
    {
        return $this->belongsTo('App\Format','FTO_ID' );
    }
    
    public function ToEventoMazo(){
        return $this->hasMany('App\DeckEvent');
    }
}
