<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Admin;
use App\Event;
use App\Location;
use App\Marker;
use App\Map;

class HomeController extends Controller
{
    public function home()
    {
        $events = Event::all();
        $maps = Map::all();

        return view('home', compact('maps', 'events'));
	}
}
