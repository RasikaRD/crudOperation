@extends('layouts.layout')
@section('title')
    Admin Todo
@endsection
@section('content')
    <h2 class="text-center mt-3 p-2">All To Do List</h2>
    <hr>
    <table class="table  table-striped">
        <thead>
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">User Name</th>
                <th scope="col">User Status</th>
                <th scope="col">To Do List Name</th>
                <th scope="col">Sub todos</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @foreach ($user->todo as $todo)
                    <tr>
                        <td colspan="1">{{ $user->id }}</td>
                        <td colspan="1">{{ $user->username }}</td>
                        <td colspan="1">User1</td>
                        <td colspan="1" class="text uppercase">{{ $todo->title }}</td>
                        <td colspan="1">
                            {{ count($todo->todolist) }}  
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>

    </table>
@endsection
