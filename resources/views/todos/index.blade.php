@extends('layouts.layout')
@section('title')
Edit Todo
@endsection
@section('content')
<div class="container w-75 align-self-center">
    <div class="container w-75 align-self-center">
        <form action="todo" method="POST" class="mt-4 p-4">
            @csrf
            <div class="form-group m-3">
                <label for="title">Todo List Name</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group m-3">
                <input type="submit" class="btn btn-primary float-end" value="Submit">
            </div>
        </form>
    </div>
    
</div>

@endsection