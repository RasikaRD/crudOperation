<?php

namespace App\Http\Controllers;

use Mailgun\HttpClient\HttpClientConfigurator;

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

    public function store()
    {
        $attributes = request()->validate([
            'password' => 'required|min:7|max:15',
            'name' => 'required|max:256',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        $configurator = new HttpClientConfigurator();
        $configurator->setApiKey('b47cabed814e39af133656d52d9c2174-b36d2969-d3c1e283');

        $mgClient = new Mailgun($configurator);

        // $mgClient = new Mailgun('b47cabed814e39af133656d52d9c2174-b36d2969-d3c1e283');
        $domain = "sandbox718734163b724837a8e5de193286ea07.mailgun.org";

        $mgClient->messages()->send(
            "$domain",
            array(
                'from'    => 'Dont Reply <postmaster@sandbox718734163b724837a8e5de193286ea07.mailgun.org>',
                'to'      => $user->email,
                'subject' => 'Welcome to To Do List',
                // 'template'    => 'todo_list',
                'html'    => view('emails.email', ['user' => $user])->render()
            )
        );
        // dd($mgClient);

        auth()->login($user);

        return redirect('/')->with('success', 'Account has been registered');
    }
}
