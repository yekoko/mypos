<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'user_id', 'name', 'address', 'phone', 'company_size',
        'image', 'registration_no', 'website', 'working_hours',
        'industry_id', 'overview', 'latitude', 'longitude'
    ];
}
