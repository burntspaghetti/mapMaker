<?php

namespace App\Http\Controllers;

use App\Event;
use App\Marker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreMapRequest;
use App\Map;


class MapController extends Controller
{
    public function create()
    {
        return view('maps.create');
    }

    public function store(StoreMapRequest $request)
    {
        Map::create($request->all());
        //put map id into session
        //redirect to map view
        return Redirect::action('HomeController@home');
    }

    public function map($id)
    {
        //get events with markers
        $map = Map::with(['events', 'markers'])->find($id);
        $markers = $map->markers->all();



        //put all the markers in an array keyed by their ids for javascript marker plotting by event.marker_id
        $markerArray = [];
        foreach($markers as $marker)
        {
            $markerArray[$marker->id] = $marker;
        }

        return view('maps.map', compact('map', 'markers', 'markerArray'));
    }


    public function createEvent(Requests\EventRequest $request)
    {
        Event::create($request->all());

        return redirect()->action('MapController@map', $request->map_id);
    }

    public function createMarker(Requests\MarkerRequest $request)
    {
        //TODO: need to make sure a marker with that color and letter is not already taken?
        Marker::create($request->all());

        return redirect()->action('MapController@map', $request->map_id);
    }

    public function test()
    {
        return view('test');
    }
}
