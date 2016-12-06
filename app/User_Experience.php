<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Experience extends Model
{
    protected $table = 'user_experience';

    public function industry()
    {
    	return $this->belongsTo('App\Industry');
    }
}
