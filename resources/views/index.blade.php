@extends('layouts.layout')
@section('title')
    First Project
@endsection
@section('content')
    <div class="row mt-3 ">
        <a href="add"><span class="btn btn-primary  mb-2 h1"><i class="fas fa-plus"></i> TO DO LIST</span></a>

        <div class="container w-75 align-self-center ">
            @if (count($todos))
                @foreach ($todos as $todo)
                    <div class="container w-70 m-2 py-2 rounded" style="background-color: rgb(187, 187, 187)">

                        <ol class="list-group">
                            <div>
                                <h4>{{ $todo->title }}</h4>
                                <a href="{{ route('index.create', $todo->id) }}"><span class="btn btn-primary mb-2 h1"><i
                                            class="fas fa-plus"></i> TO DO</span></a>
                                <hr>
                            </div>

                            @if (count($todo->todolist))
                                @foreach ($todo->todolist as $todolist)
                                    <table class="table rounded-xl" style="background-color: rgb(128, 128, 128)">

                                        <tr>
                                            <td class="col-6">
                                                <b>{{ $todolist->contents }}</b>
                                            </td>
                                            <td class="col-3">
                                                <a href="/edit/{{ $todolist->id }}"><span class="btn btn-primary"><i
                                                            class="fas fa-pencil"></i></span></a>
                                            </td>
                                            <td class="col-3">
                                                <a href="/delete/{{ $todolist->id }}"><span class="btn btn-danger"><i
                                                            class="fas fa-trash"></i></span></a>
                                            </td>

                                    </table>
                                    <!-- <li class="list-group-item w-75 align-self-center"><a href="details" style="color: black">{{ $todolist->contents }}</a></li> -->
                                @endforeach
                            @else
                                <div class="alert alert-success  mt-5 align-self-center text-center">No To do task yet !</div>
                            @endif

                        </ol>
                        @if (count($todo->todolist) < 2)
                            <div class="alert alert-success  mt-5 align-self-center text-center">
                                You have <b> {{ count($todo->todolist) }} </b> task in <b>{{ $todo->title }} To do
                                    List</b>...
                            </div>
                        @else
                            <div class="alert alert-success  mt-5 align-self-center text-center">
                                You have <b> {{ count($todo->todolist) }} </b> tasks in <b>{{ $todo->title }} To do
                                    List</b>...
                            </div>
                        @endif
                        <hr>
                        <a href="/remove/{{ $todo->id }}"><span class="btn btn-danger mb-2 h5"><i
                                    class="fas fa-trash"></i></span></a>
                    </div>
                @endforeach
            @else
                <div class="alert alert-success   mt-5 align-self-center text-center">No To do list yet !</div>
            @endif

        </div>
    </div>
@endsection
