<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

    protected $fillable = [
        'title', 'company_id', 'category_id', 'experience_id',
        'min_salary', 'max_salary', 'requirements', 'responsibilities',
        'description', 'email', 'phone_no', 'address', 'end_date'
    ];

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
