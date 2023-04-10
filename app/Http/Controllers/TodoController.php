<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Todolist;
use Nette\Schema\ValidationException;
use App\Models\User;
use App\Notifications\TodoNotificatin;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add()
    {

        return view('todos.index');
    }


    public function store()
    {
        try {
            $this->validate(request(), [
                'title' => 'required|min:3|max:255',
            ]);
        } catch (ValidationException $e) {
        }

        $data = request()->all();

        $todo = new Todo();

        $todo->title = $data['title'];
        $todo->user_id = auth()->user()->id;
        $todo->save();

        //notification 

        $admin = User::where('username', 'admins')->first();
        // dd($todo);
        // dd($admin);
        $admin->notify(new TodoNotificatin($todo));

        session()->flash('success', 'TODO LIST ADDED');

        return redirect('/');
    }


    public function destroy(Todo $todo)
    {
        // $this->authorize('delete', $todo);
        $todo->delete();
        session()->flash('Deleted!', 'TODO LIST DELETED');
        return redirect('/');
    }
}
