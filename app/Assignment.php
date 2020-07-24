<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['position', 'internal_rate', 'external_rate', 'date_start', 'date_end', 'id_project', 'id_user'];
}
