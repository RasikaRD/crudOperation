@extends('layouts.layout')
@section('title')
    First Project
@endsection
@section('content')

    <div class="row mt-3 mb-1 ">
        @can('admin')
            <div class="container col-8 mt-4 border-1 bg-gray-300 rounded-xl">
                <h2 class="text-center mt-3 p-2">Admin section</h2>
                <hr>
            </div>
        @endcan
        @auth
            <a href="add"><span class="btn btn-primary  mb-2 h1 ml-5 "><i class="fas fa-plus"></i> TO DO LIST </span></a>

            <div class="container align-self-center ">
                @if (count($todos))
                    @foreach ($todos as $todo)
                        @if ($todo->user_id == auth()->user()->id)
                            <div class="container  mb-5 py-2 rounded-xl" style="background-color: rgb(187, 187, 187)">

                                <ol class="list-group">
                                    <div class="flex mt-2">
                                        <div class="col-10">
                                            <h4 class="ml-5 mr-5 mt-1 uppercase">{{ $todo->title }}</h4>
                                            <div class="container mt-2 mb-3 border-2 bg-gray-300 rounded-xl p-2">
                                                <span class=" border-1 bg-gray-500 rounded-2 p-1 uppercase">
                                                    <b> Collaborative users :</b></span>  
                                                    @foreach ($collaborators as $cuser)
                                                    @if ($todo->id == $cuser->todo_id)
                                                        <?php $user = App\Models\User::find($cuser->user_id); ?>
                                                        <span class=" border-1 bg-gray-400 rounded-2 p-1 uppercase">{{ $user->name }}</span>
                                                    @endif
                                                    @endforeach

                                            </div>

                                            <a href="{{ route('index.create', $todo->id) }}"><span
                                                    class="btn btn-primary btn-sm mb-2 h5 ml-4"><i class="fas fa-plus"></i> TO
                                                    DO</span></a>

                                        </div>
                                        <div class="col-2 mb-3 ml-1">
                                            <div>
                                                <form method="post" action="/remove/{{ $todo->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm mt-1 ml-1" type="submit"> Delete To Do
                                                        List </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @if (count($todo->todolist))
                                        @foreach ($todo->todolist as $todolist)
                                            <table class="table rounded-xl h6 text-left mr-1 px-0 py-0"
                                                style="background-color: rgb(128, 128, 128)">

                                                <tr>
                                                    <td class="col-8 py-3 ">
                                                        <b>{{ $todolist->contents }}</b>
                                                    </td>
                                                    <td class="col-2 ">
                                                        @if ($todolist->status == 0)
                                                            <span class="badge bg-warning text-dark mt-2">Not Completed</span>
                                                            <a href="/done/{{ $todolist->id }}"><span
                                                                    class="btn btn-warning btn-sm ">
                                                                    <i class="fas fa-check "></i></span></a>
                                                        @else
                                                            <span class="badge bg-success mt-2">Completed <i
                                                                    class="fa fa-check-square " aria-hidden="true"></i></span>
                                                        @endif

                                                    </td>
                                                    <td class="col-1">
                                                        <a href="/edit/{{ $todolist->id }}"><span
                                                                class="btn btn-primary mt-1 btn-sm"><i
                                                                    class="fas fa-pencil"></i></span></a>
                                                    </td>
                                                    <td class="col-1">
                                                        <form method="post" action="/delete/{{ $todolist->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger mt-1 ml-1 btn-sm" type="submit">
                                                                <i class="fas fa-trash"></i> </button>
                                                        </form>
                                                        {{-- <a href="/delete/{{ $todolist->id }}"><span
                                                                class="btn btn-danger btn-sm"></span></a> --}}
                                                    </td>

                                            </table>
                                        @endforeach
                                    @else
                                        <div class="alert alert-success  mt-3 align-self-center text-center">No To do task yet !
                                        </div>
                                    @endif

                                </ol>
                                @if (count($todo->todolist) < 2)
                                    <div class="alert alert-success  mt-3 align-self-center text-center">
                                        You have <b> {{ count($todo->todolist) }} </b> task in <b>{{ $todo->title }} To do
                                            List</b>...
                                    </div>
                                @else
                                    <div class="alert alert-success  mt-3 align-self-center text-center">
                                        You have <b> {{ count($todo->todolist) }} </b> tasks in <b>{{ $todo->title }} To do
                                            List</b>...
                                    </div>
                                @endif

                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="alert alert-success  mt-4 align-self-center text-center">No To do list yet !</div>
                @endif
            @else
                <div class="alert alert-success   mt-4 align-self-center text-center">Please Log In Now!</div>
            @endauth


        </div>
    </div>
@endsection
