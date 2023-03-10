<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Todolist;
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
                'title' => 'required|min:3|max:255',
            ]);
        } catch (ValidationException $e) {
        }

        $data = request()->all();

        $todo = new Todo();
        
        $todo->title = $data['title'];
        $todo->user_id = auth()->user()->id;
        

        $todo->save();

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
