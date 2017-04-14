<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $fillable = ['map_id', 'lat', 'lng', 'date_occurred', 'details', 'marker_id'];
    public $timestamps = false;

    protected $table = 'event';

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function map()
    {
        return $this->belongsTo('App\Map');
    }

    public function marker()
    {
        //pass foreign key as second param if necessary
        return $this->belongsTo('App\Marker', 'marker_id');
    }

    public function eventType()
    {
        return $this->belongsTo('App\EventType');
    }
}
