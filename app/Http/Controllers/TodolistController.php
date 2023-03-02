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


    public function edit(Todolist $todolist) 
    {
        $todolist = Todolist::get();
        return view('edit',[
            'todolist' => $todolist->get()
        ]);
          
            //return array_merge($todolist->toArray(), $data);

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, $id)
    {
        try {
            $this->validate(request(), [
                'contents' => ['required'],
           
            ]);
        } catch (ValidationException $e) {
        }
        $todolist = $this->find($id);
        $todolist->update($this->edit($todolist, $data));
        // $todolist->contents = $data['contents'];
        // $todolist->update();

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
