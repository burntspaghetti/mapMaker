<?php

namespace App\Http\Controllers;

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
        $map = Map::with(['events'])->find($id);
        return view('maps.map', compact('map'));
    }

    public function createEvent(Requests\StoreEventRequest $request)
    {
        dd($request);

    }
}
