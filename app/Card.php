<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table      = 'cards';
    protected $primaryKey = 'CRT_ID';
    
    protected $fillable = array(
                                'CRT_NUMERO_EDICION',
                                'CRT_NOMBRE',
                                'CRT_TIPO',
                                'CRT_MANA',
                                'CRT_RAREZA',
                                'CRT_ARTISTA',
                                'CRT_EDICION',
                                'EDN_COD_INTERNO',
                                'EDN_ID',
                                'CRT_IMAGEN',
                               );
    public $timestamps = false;
    
    
     public function ToListaCarta(){
            return $this->hasMany('App\List', 'CRT_ID');

    }
}
