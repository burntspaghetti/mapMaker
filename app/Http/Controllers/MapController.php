<?php

namespace App\Http\Controllers;

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
        //get marker list for dropdown

        return view('maps.map', compact('map'));
    }


    public function createEvent(Requests\StoreEventRequest $request)
    {
        dd($request);

    }

    //is inserting html a security risk?
    //how to minimize?
//    TODO: clean up old erd stuff: location model
    public function createMarker(Requests\MarkerRequest $request)
    {
        Marker::create($request->all());

        return redirect()->action('MapController@map', $request->map_id);
    }

    public function test()
    {
        return view('test');
    }
}
