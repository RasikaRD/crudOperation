<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create(){

        return view('session.login');

    }

    public function store(){
        $attributes = request()->validate([
            'username' =>'required',
            'password' =>'required'
        ]);
        if (auth()->attempt($attributes)){
            session()->regenerate();
            return redirect('/')->with('success','Login successful');
        }

        return back()
        ->withInput()
        ->withErrors(['username' => 'Your username is invalid']);
    }

    public function destroy(){

        auth()->logout();
        return redirect('/')->with('success', 'Successfully Logout');
    }
}
