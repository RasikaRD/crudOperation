@extends('layouts.layout')
@section('title')
Edit Todo
@endsection
@section('content')
<div class="container  align-self-center">
    <div class="container  align-self-center">
        <form action="todo" method="POST" class="mt-4 p-4">
            @csrf
            <div class="form-group m-3">
                <label for="title"><strong> List Name</strong></label>
                <input type="text" class="form-control mt-3 w-80" name="title" required>
            </div>
            <div class="form-group m-3">
                <input type="submit" class="btn btn-primary float-end" value="Submit">
            </div>
        </form>
    </div>
    
</div>

@endsection