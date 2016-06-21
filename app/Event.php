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
    protected $table = 'event';

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    public function marker()
    {
        //pass foreign key as second param if necessary
        return $this->belongsTo('App\Marker');
    }

}
