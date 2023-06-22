<?php

namespace App\Http\Controllers;

use App\Mail\approvedtMail;
use App\Mail\attachmentMail;
use Mailgun\HttpClient\HttpClientConfigurator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Nette\Schema\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserWelcomeMail;

use Mailgun\Mailgun;

class RegisterController extends Controller
{
    public function register()
    {
        return view('registers.register');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'password' => 'required|min:7|max:15',
            'name' => 'required|max:256',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        Mail::to($request->user())->send(new NewUserWelcomeMail($user));

        auth()->login($user);

        return redirect('/')->with('success', 'Account has been registered');
    }

    public function email()
    {
        return view('emails.welcome_email');
    }
    public function view(){
        $user = auth()->user();
        return view('auth.profile', compact('user'));
    }
}
