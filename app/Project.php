<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'date_start', 'date_end', 'id_cliente'];
    
    public function projects() 
    {	
		return $this->belongsTo('App\Client');
	}

}
