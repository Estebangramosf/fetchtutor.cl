<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{
    protected $table      = 'card_types';
    protected $primaryKey = 'TCR_ID';
    
    protected $fillable = array(
                                'TCR_NOMBRE',
                               );
    public $timestamps = false;
    
    
    public function ToLista(){
            return $this->hasMany('App\List', 'TCR_ID');

    }
}
