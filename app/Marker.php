<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marker';

    /**
     * Get the events for the marker.
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }

}
