<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'event_type';

    /**
     * Get the events for the marker.
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }

}
