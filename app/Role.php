<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends \Cartalyst\Sentinel\Roles\EloquentRole
{
	protected $table = 'roles';
    protected $hidden = [
        'created_at', 'updated_at','pivot'
    ];
}
