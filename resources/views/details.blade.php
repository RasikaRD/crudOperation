@extends('layouts.layout')
@section('title')
details
@endsection

@section('content')

<div class="container w-75 align-self-center">
        <div class="card-header">
            <b>TODO LIST</b>
        </div>
        <div class="card-body">
            <h5 class="card-title">Todo name here</h5>
            <a href="update/{{$todolist->id}}"><span class="btn btn-primary"><i class="fas fa-pencil"></i></span></a>
        </div>
    </div>

@endsection
