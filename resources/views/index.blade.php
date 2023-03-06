@extends('layouts.layout')
@section('title')
    First Project
@endsection
@section('content')
    <div class="row mt-3 mb-1 ">
        @auth
            <a href="add"><span class="btn btn-primary  mb-2 h1 ml-10"><i class="fas fa-plus"></i> TO DO LIST </span></a>

            <div class="container w-75 align-self-center ">
                @if (count($todos))
                    @foreach ($todos as $todo)
                        @if ($todo->user_id == auth()->user()->id)
                            <div class="container w-70 m-2 py-2 rounded" style="background-color: rgb(187, 187, 187)">

                                <ol class="list-group">
                                    <div class="flex mt-2">
                                        <div class="col-9">
                                            <h4 class="ml-5 mr-5 mt-1 uppercase">{{ $todo->title }}</h4>
                                        </div>
                                        <div class="col-3 mb-2">
                                            <a href="{{ route('index.create', $todo->id) }}"><span
                                                    class="btn btn-primary mb-2 h5 ml-15"><i class="fas fa-plus"></i> TO
                                                    DO</span></a>
                                            <a href="/remove/{{ $todo->id }}"><span class="btn btn-danger mb-2 h1 ml-1"><i
                                                        class="fas fa-trash"></i></span></a>
                                        </div>
                                    </div>

                                    @if (count($todo->todolist))
                                        @foreach ($todo->todolist as $todolist)
                                            <table class="table rounded-xl h6 text-left ml-1 mr-1 px-0 py-0"
                                                style="background-color: rgb(128, 128, 128)">

                                                <tr>
                                                    <td class="col-8 py-3 ">
                                                        <b>{{ $todolist->contents }}</b>
                                                    </td>
                                                    <td class="col-2">
                                                        <a href="/edit/{{ $todolist->id }}"><span class="btn btn-primary"><i
                                                                    class="fas fa-pencil"></i></span></a>
                                                    </td>
                                                    <td class="col-2">
                                                        <a href="/delete/{{ $todolist->id }}"><span class="btn btn-danger"><i
                                                                    class="fas fa-trash"></i></span></a>
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
