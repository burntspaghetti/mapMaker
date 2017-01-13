<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $table = 'event';

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
