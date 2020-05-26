<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['ragione_sociale', 'nome_referente', 'cognome_referente', 'email', 'ssid', 'pec', 'partita_iva'];


    public function expenses() 
   	{	
		return $this->hasMany('App\Project');
	}
   
}
