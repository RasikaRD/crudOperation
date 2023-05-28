<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  
    public function register(Request $request)
    {
        $attributes = request()->validate([
            'password' => 'required|min:7|max:15',
            'name' => 'required|max:256',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);
        $token = $user->createToken('MyApp')->accessToken;
        return response()->json(['data'=>$attributes, 'token'=>$token,'status'=>true,'message'=>'Success'], 200);
    }

    public function login()
    {
        $attributes = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (auth()->attempt($attributes)) {
        session()->regenerate();
        
         /** @var \App\Models\MyUserModel $user **/
        $user = Auth::user();
        $token = $user->createToken('MyApp')->accessToken;
        return response()->json(['token'=>$token], 200);
        }      
    }
}
