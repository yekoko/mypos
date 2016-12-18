<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saved_Job extends Model
{
    protected $table = "saved_jobs";

    public function job()
    {
    	return $this->belongsTo('App\Job');
    }
}
