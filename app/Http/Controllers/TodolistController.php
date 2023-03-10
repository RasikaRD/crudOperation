<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Todolist;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this ->authorize('admin');
        $todos = Todo::latest()->get();
        return view('index', compact('todos'));
    }

    public function create($id)
    {

        $todo = new Todo();
        $result = $todo->find($id);
        return view('create', [
            'todo' => $result
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
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


    public function edit($id)
    {
        $todolist = new Todolist();
        $result = $todolist->find($id);

        return view('edit', [
            'todolist' => $result
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {

        try {
            $this->validate(request(), [
                'contents' => 'required',
            ]);
        } catch (ValidationException $e) {
        }

        $todolist = Todolist::find($id);

        if (isset($request['contents'])) {
            $todolist->contents = $request['contents'];
        }

        $todolist->update();

        session()->flash('success', 'Todo updated successfully');

        return redirect('/');
    }
    public function done(Todolist $todolist)
    {

        $todolist->status = 1;
        $todolist->update();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Todolist $todolist)
    {

        $todolist->delete();
        session()->flash('Deleted!', 'TODO LIST DELETED');
        return redirect('/');
    }


}
