<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreMapRequest;


class MapController extends Controller
{
    public function create()
    {
        return view('maps.create');
    }

    public function store(StoreMapRequest $request)
    {
        dd($request);

    }
}
