<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin';

    /**
     * Get the events created by the admin.
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }

}
