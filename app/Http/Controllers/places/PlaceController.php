<?php

namespace App\Http\Controllers\places;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Auth;


class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $places = Place::all();
        return response(['success' => 'Data retrieve successfully','places' => $places]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:50|unique:places',
            'description' => 'required|max:225|min:3',
            'location' => 'required|max:225|min:10',
            'image' => 'required|max:225|min:2',
            'price' => 'required|numeric|min:1',
            'offer' => 'required|numeric|min:1',
            'category_id' => 'required|numeric|min:1',
        ]);
        $request->merge(['admin_id' => Auth::user()->id]);
        $input = $request->all();
        $place= Place::create($input);
        return response(['place' => $place]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        //
    }
}
