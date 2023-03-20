<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Todolist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Schema\ValidationException;
use Spatie\FlareClient\Http\Response as HttpResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $todos = Todo::where('user_id', auth()->id())->get();
        return view('index', compact('todos'));
    }

    public function create($id)
    {
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'sub_admin']);
        // Role::create(['name' => 'user']);

        // Permission::create(['name' => 'view_todo']);
        // Permission::create(['name' => 'add_todo']);
        // Permission::create(['name' => 'delete_todo']);
        // Permission::create(['name' => 'view_sub_todo']);
        // Permission::create(['name' => 'add_sub_todo']);


        //$admin->givePermissionTo('view_todo');
        // $admin->givePermissionTo('add_todo');
        // $admin->givePermissionTo('delete_todo');
        // $admin->givePermissionTo('view_sub_todo');
        // $admin->givePermissionTo('add_sub_todo');

        // $sub_admin->givePermissionTo('view_todo');
        // $sub_admin->givePermissionTo('add_todo');
        // $sub_admin->givePermissionTo('view_sub_todo');
        // $sub_admin->givePermissionTo('add_sub_todo');

        // $user->givePermissionTo('view_todo');
        // $user->givePermissionTo('view_sub_todo');

        //     $admin = User::find(2);
        //     $sub_admin = User::find(3);
        //     $user = User::find(1);

        //     $admin->assignRole('admin');
        //     $sub_admin->assignRole('sub_admin');
        //     $user->assignRole('user');


        //    $role_admin = Role::where('name', 'admin')->first();
        //    $role_sub_admin = Role::where('name', 'sub_admin')->first();
        //    $role_user = Role::where('name', 'user')->first();

        //    $role_admin->assignPermission('view_todo');
        //    $role_admin->assignPermission('add_todo');
        //    $role_admin->assignPermission('delete_todo');
        //    $role_admin->assignPermission('view_sub_todo');
        //    $role_admin->assignPermission('add_sub_todo');

        //    $role_sub_admin->assignPermission('view_todo');
        //    $role_sub_admin->assignPermission('add_todo');
        //    $role_sub_admin->assignPermission('view_sub_todo');
        //    $role_sub_admin->assignPermission('add_sub_todo');

        //    $role_user->assignPermission('view_todo');
        //    $role_user->assignPermission('view_sub_todo');

        // if (Auth::guest()) {
        //     return redirect('/');
        // }
        // $todo = new Todo();
        // $result = $todo->find($id);
        if(
        $result = Todo::where('user_id', auth()->id())->find($id)){
        return view('create', [
            'todo' => $result
        ]);}
        else{
            abort(Response::HTTP_FORBIDDEN);
        }
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
        $todolist->user_id =auth()->user()->id;
        $todolist->save();

        session()->flash('success', 'Todo created successfully');

        return redirect('/');
    }


    public function edit($id)
    {
        if(
            $result = Todolist::where('user_id', auth()->id())->find($id)){
            return view('edit', [
                'todolist' => $result
            ]);}
            else{
                abort(Response::HTTP_FORBIDDEN);
            }
        // $todolist = new Todolist();
        // $result = $todolist->find($id);
        // return view('edit', [
        //     'todolist' => $result
        // ]);

        
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
