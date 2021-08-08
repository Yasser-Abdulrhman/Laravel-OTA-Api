<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Place;
use App\Models\UserPlace;
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\Places\Place as PlaceResource;
use App\Http\Resources\User\User as UserResource;

class UserController extends Controller
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
            'bookings'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function index()
    {
        //
        $users = User::paginate(3);
        return UserResource::collection($users);

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
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required',
            'role' => 'require' 
        ]);
        $data=$request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        //$accessToken = $user->createToken('authToken')->accessToken;
        //return response([ 'user' => $user]);
        return new UserResource($user);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $user = User::find($id);
        return new UserResource($user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        User::find($id)->delete();
        return $this->sendResponse([], 'Place deleted successfully.');

    }

    public function userPlaces()
    {
        $user = User::find(auth()->user()->id);
        $places =  $user->places;     
        return PlaceResource::collection($places);
    }

    public function placesUsers(Place $place)
    {
        $users = $place->users;
        return UserResource::collection($users);
    }

    public function bookings()
    {
        // $bookings = UserPlace::where('user_id' , auth()->user()->id)->count();
        // $bookings = User::withCount('places')->get()->where('places_count' , '>' , '0');
        $bookings = User::withCount('places')->where('id' , '=' , auth()->user()->id)->get();
        // return $this->sendResponse($bookings, 'number of bookings of user');
        return response()->json($bookings, 200);

    }

}
