<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
    public function experience()
    {
    	return $this->belongsTo('App\Experience');
    }
    public function company($value='')
    {
    	return $this->belongsTo('App\Company');
    }
}
