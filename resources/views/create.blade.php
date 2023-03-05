@extends('layouts.layout')
@section('title')
    New Todo
@endsection
@section('content')
    <div class="container w-75 align-self-center">
        <form action="/create/{id}/store" method="post" class="mt-4 p-4">
            @csrf
            <div class="form-group m-3">
                <label for="contents">Todo Name</label>
                {{-- <input type="hidden" name="todo_id" value="{{ $todo->id }}"> --}}
                <input type="text" class="form-control mt-3" name="contents">
            </div>
            <div class="form-group m-3">
                <input type="submit" class="btn btn-primary float-end" value="Submit">
            </div>
        </form>
    </div>
    
@endsection