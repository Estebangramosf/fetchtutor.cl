<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table      = 'players';
    protected $primaryKey = 'JGD_ID';
    
    protected $fillable = array(
                                'JGD_NOMBRE',
                                'JGD_DCI',
                               );
    public $timestamps = false;
    
    
    
    public function ToEventoMazo(){
        return $this->hasMany('App\DeckEvent');
    }
    
}
