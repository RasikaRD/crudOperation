@extends('layouts.layout')
@section('title')
    Edit Todo
@endsection
@section('content')
@auth
    <div class="container w-75 align-self-center">
        <form action="/update/{{$todolist->id}}" method="post" class="mt-4 p-4">
           @csrf
            <div class="form-group m-3">
                <h3><label for="contents">{{ $todolist->contents }}</label></h3>
                <input type="text" id="contents" class="form-control" name="contents" value="{{ $todolist->contents }}">
            </div>
            <div class="form-group m-3">
                <input type="submit" class="btn btn-primary float-end" value="Update">
            </div>
        </form>
    </div>
@endauth
@endsection
