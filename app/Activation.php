<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activation extends \Cartalyst\Sentinel\Activations\EloquentActivation
{
     protected $table = 'activations';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'code',
        'completed',
        'completed_at',
    ];
     
}
