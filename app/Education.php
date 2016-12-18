<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = "educations";

     protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function qualification()
    {
    	return $this->belongsTo('App\Qualification');
    }
}
