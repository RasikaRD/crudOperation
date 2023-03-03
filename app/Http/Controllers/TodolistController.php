<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Todolist;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $todos= Todo::latest();
        return view('index',[
            'todos' => $todos->get()
        ]);
    }

    public function create($id) 
    {
        
        return view('create')->with(compact('id'));
    } 

    /**
     * Store a newly created resource in storage.
     */

    public function store() 
    {

        
        try {
            $this->validate(request(), [
                'contents' => ['required'],
            ]);
        } catch (ValidationException $e) {
        }
        

        $data = request()->all();

        $todolist = new Todolist();
        
        $todolist->contents = $data['contents'];
        $todolist->save();

        session()->flash('success', 'TODO LIST ADDED');

        return redirect('/');


        
    //     try {
    //         $this->validate(request(), [
    //             'contents' => ['required']
    //         ]);
    //     }
    //     catch (ValidationException $e) {
    //     }
        
    //     $todo = $request->id;
    //     $data = $request->all();

    //     $todolist = new Todolist();
    //     $todolist->contents = $data['contents'];
    //     $todolist->todo_id = $todo->id;
    //     $todolist->save();

        
    //     session()->flash('success','TODO ADDED');
    //     return redirect('/');
    // }
    }


    public function edit($id) 
    {
        $todolist = new Todolist();
        $result = $todolist->find($id);

        return view('edit',[
            'todolist' =>$result
        ]);
          
            //return array_merge($todolist->toArray(), $data);

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

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Todolist $todolist)
    {

        $todolist->delete();
        return redirect('/');
    }


}
