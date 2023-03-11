<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class SessionController extends Controller
{
    public function create()
    {

        return view('session.login');
    }

    public function store()
    {
        try {
            $attributes = request()->validate([
                'username' => 'required',
                'password' => 'required'
            ]);
        } catch (ValidationException) {
        }
        if (auth()->attempt($attributes)) {
            session()->regenerate();
            return redirect('/')->with('success', 'Login successful');
        }

        return back()
            ->withInput()
            ->withErrors(['username' => 'Your credential is invalid']);
    }

    public function destroy()
    {

        auth()->logout();
        return redirect('/')->with('success', 'Successfully Logout');
    }
}
