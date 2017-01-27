<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'map';

    protected $fillable = ['name', 'lat', 'lng', 'desc'];

    public $timestamps = false;

    /**
     * Get the events for the marker.
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function markers()
    {
        return $this->hasMany('App\Marker');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

}
