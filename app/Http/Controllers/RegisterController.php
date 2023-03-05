<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(){
        return view('registers.register');
    }

    public function store(){

        $attributes = request()->validate([
            'password' =>'required|min:7|max:10',
            'name' =>'required|max:256',
            'username' =>'required|min:3|max:255|unique:users,username',
            'email' =>'required|email|max:255|unique:users,email'
        ]);
        
        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        auth()->login($user);

        return redirect('/')->with('success', 'Account has been registered');
    }

  
}
