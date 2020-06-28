<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $fillable = ['id_project', 'id_user', 'id_assignment', 'note', 'ore', 'date'];

}
