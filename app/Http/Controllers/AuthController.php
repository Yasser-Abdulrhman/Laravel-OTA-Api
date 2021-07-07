<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required' 
        ]);
        $data=$request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($loginData)){
            return response(['message' => 'Invalid Credentials']);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    // public function adminRegister(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|max:55',
    //         'email' => 'email|required|unique:users',
    //         'password'=> 'required' 
    //     ]);
    //     $data=$request->all();
    //     $data['password'] = bcrypt($request->password);
    //     $admin = Admin::create($data);
    //     $accessToken = $admin->createToken('authToken')->accessToken;
    //     return response([ 'admin' => $admin, 'access_token' => $accessToken]);
    // }
    // public function adminLogin(Request $request)
    // {
    //     $loginData = $request->validate([
    //         'email' => 'email|required',
    //         'password' => 'required'
    //     ]);
    //     if(!auth()->guard('admin-api')->attempt($loginData)) {
    //         return response(['message' => 'Invalid Credentials']);
    //     }
    //     $accessToken = auth()->guard('admin')->createToken('authToken')->accessToken;
    //     return response(['admin' => auth()->guard('admin'), 'access_token' => $accessToken]);
    // }

    
}
