<?php

namespace App\Http\Controllers\places;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\Places\Place as PlaceResource;
use App\Http\Resources\Places\Category as CategoryResource;



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


    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function index()
    {
        // $places = Place::all();
        $places = Place::paginate(3);
        // return $this->sendResponse(PlaceResource::collection($places), 'places retrieved successfully.');
        return PlaceResource::collection($places);
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
        return $this->sendResponse(new PlaceResource($place), 'Place created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        
        // return response(['success' => 'Data retrieve successfully','place'=> $place]);
        // return $this->sendResponse(new PlaceResource($place), 'Place retrieved successfully.');
        return new PlaceResource($place);
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
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|max:225|min:3',
            'location' => 'required|max:225|min:10',
            'image' => 'required|max:225|min:2',
            'price' => 'required|numeric|min:1',
            'offer' => 'required|numeric|min:1',
            'category_id' => 'required|numeric|min:1',         
        ]);
        $input = $request->all();
        $place->name = $input['name'];
        $place->description = $input['description'];
        $place->location = $input['location'];
        $place->image = $input['image'];
        $place->price = $input['price'];
        $place->offer = $input['offer'];
        $place->category_id = $input['category_id'];
        $place->save();
        return $this->sendResponse(new PlaceResource($place), 'Place updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();        
        return $this->sendResponse([], 'Place deleted successfully.');
    }


    public function category(Place $place)
    {
        $category = Category::find($place);
        return $this->sendResponse(CategoryResource::collection($category),'category retrieved successfully.');
    }
}
