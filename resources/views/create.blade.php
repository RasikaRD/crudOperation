@extends('layouts.layout')
@section('title')
New Todo
@endsection
@section('content')
<div class="container w-75 align-self-center">
    <div class="container w-75 align-self-center">
        <form action="store" method="post" class="mt-4 p-4">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            <div class="form-group m-3">
                <label for="contents">Todo Name</label>
                <input type="text" class="form-control" name="contents">
            </div>
            <div class="form-group m-3">
                <input type="submit" class="btn btn-primary float-end" value="Submit">
            </div>
        </form>
    </div>
    
</div>

@endsection