<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $fillable = ['id_project', 'id_user', 'note', 'ore', 'date'];
    protected $table = 'time_entry';
}
