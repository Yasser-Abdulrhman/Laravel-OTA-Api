<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\places\PlaceController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/register', 'App\Http\Controllers\AuthController@register');
// Route::post('/login', 'App\Http\Controllers\AuthController@login');
// Route::post('/login', 'AuthController@login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['isAdmin']], function () {
    
    Route::resource('place', 'App\Http\Controllers\Places\PlaceController');
    Route::resource('category', 'App\Http\Controllers\Places\CategoryController');
    Route::get('places/{category}' , 'App\Http\Controllers\Places\CategoryController@places');
    Route::get('categorydetails/{place}' , 'App\Http\Controllers\Places\PlaceController@category');
    Route::get('userplaces' , 'App\Http\Controllers\User\UserController@userPlaces');
    Route::get('placeusers/{place}' , 'App\Http\Controllers\User\UserController@placesUsers');
    Route::get('bookings','App\Http\Controllers\User\UserController@bookings');
 
});


