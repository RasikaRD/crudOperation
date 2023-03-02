<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Todolist;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add()
    {
        
        return view('todos.index');
    }

 
    public function store()
    {

        try {
            $this->validate(request(), [
                'title' => ['required'],
            ]);
        } catch (ValidationException $e) {
        }

        $data = request()->all();

        $todo = new Todo();
        
        $todo->title = $data['title'];
        $todo->save();

        session()->flash('success', 'TODO LIST ADDED');

        return redirect('/');
    }


    public function remove(Todo $todo, Todolist $todolist)
    {
        $todo->delete();
        $todolist->delete();
        return redirect('/');
    }
}
