@extends('layouts.layout')
@section('title')
Edit Todo
@endsection
@section('content')

    <form action="update/$todolist->id" method="post" class="mt-4 p-4">
    @csrf
    
    <div class="form-group m-3">
        {{-- <input name="id" value="{{ $todolist->id }}" type="hidden"> --}}
        <label for="contents">{{$todolist->contents}}</label>
        <input type="text" class="form-control" name="contents" value="{{$todolist->contents}}">
       
    </div>
    <div class="form-group m-3">
        <input type="submit" class="btn btn-primary float-end" value="Update">
    </div>
    </form>

@endsection