<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
 
class User extends \Cartalyst\Sentinel\Users\EloquentUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','phone','nrc_no','photo','code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','pivot',
    ];

    protected $loginNames = ['email','phone'];

    public function delivery_staff()
    {
        return $this->hasMany('App\Delivery_staff');
    }
      


     
}
