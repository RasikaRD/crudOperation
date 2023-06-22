@extends('layouts.layout')
@section('title')
    New Todo
@endsection
@section('content')
    @auth
   
        <div class="container  col-lg-6  col-sm-12 align-self-center">
            <form action="/create/store" method="post" class="mt-4 p-4">
                @csrf
                <div class="form-group m-3">
                    <h2 class="uppercase">{{ $todo->title }}</h2>
                    <label for="contents"><strong> Todo Name</strong></label>
                    <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                    <input type="text" class="form-control mt-3" name="contents" id="contents" value="{{ old('contents') }}"
                        required>
                    @error('contents')
                        <p class="text-red-400 text-xs mt-1"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group m-3">
                    <input type="submit" class="btn btn-primary float-end" value="Submit">
                </div>
        </div>

        </form>
        </div>
        
    @endauth
@endsection
