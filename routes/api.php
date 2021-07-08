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
    // Route::resource('/place', [PlaceController::class]);
});



// Route::resource('/place', [places\PlaceControlller::class]);



// Route::resource('/place', [UserController::class]);
