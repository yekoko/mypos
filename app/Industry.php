<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $table = 'industries';
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
