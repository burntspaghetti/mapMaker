<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    public $timestamps = false;
    protected $table = 'marker';
    protected $fillable = ['type', 'letter', 'color', 'map_id'];

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
