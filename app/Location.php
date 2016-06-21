<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'location';

    /**
     * Get the events for the location.
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }

}
