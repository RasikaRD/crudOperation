<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Todolist;
use App\Models\User;
use Nette\Schema\ValidationException;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Notifications\DatabaseNotification;

class AdminController extends Controller
{
    public function add()
    {
        $todos = Todo::latest()->get();
        $users = User::latest()->get();
        
        
        return view('todos.admin', compact('users'));
    }

    public function post(){
        
        Gate::allowIf(fn (User $user) => $user->isAdministrator());
        

        try {
            $this->validate(request(), [
                'contents' => 'required|min:3|max:255',

            ]);
        } catch (ValidationException $e) {
        }


        $data = request()->all();

        $todolist = new Todolist();
        $todolist->contents = $data['contents'];
        $todolist->todo_id = $data['todo_id'];
        $todolist->save();

        session()->flash('success', 'Todo created successfully');

        return redirect('/');

    }

    public function get($notificationId){

        $admin = User::where('username', 'admins');
     
        // $notification = $admin->unreadNotifications->first();
        // $notification->markAsRead();
        // dd($notificationId);
        
        $notification = DatabaseNotification::findOrFail($notificationId);
        if ($notificationId == $notification->id) {
            $notification->markAsRead();
            // dd( $notification->id);
        }

        $users = User::latest()->get();
        return view('todos.admin', compact('users'));
        // return redirect()->back();
    }
}
