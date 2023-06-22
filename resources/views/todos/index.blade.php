@extends('layouts.layout')
@section('title')
    Add new TODO
@endsection
@section('content')
    @auth
        <div class="container  align-self-center">
            <div class="container  align-self-center">
                <form action="todo" method="POST" class="mt-4 p-4">
                    @csrf
                    <div class="form-group m-3">
                        <label for="collaborators"><strong> Collaborative users</strong></label>
                        <div class="container mt-2 mb-3 border-2 bg-gray-300 rounded-xl p-2">
                            <button class="btn btn-primary dropdown-toggle mb-1  h5 ml-1 mr-4 mt-1" type="button"
                                id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false" for="collaborators">
                                <i class="fas fa-plus"></i><b> Collaborative users</b></button>

                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton3">
                                @foreach ($users as $user)
                                    <li ><a class="dropdown-item uppercase" href="#">
                                        @if ($user->id != auth()->user()->id && $user->username != 'admins')
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                    id="collaborators"   value="{{ $user->id }}"
                                                    name="collaborators[]" multiple/>
                                                <label class="form-check-label"
                                                   >{{ $user->name }}</label>
                                            </div>
                                            @endif
                                        </a></li>
                                @endforeach
                            </ul>

                        </div>
                        <label for="title"><strong> Todo List Name</strong></label>

                        <input type="text" class="form-control mt-3 w-80" id="title" name="title"
                            value="{{ old('title') }}" required>
                        @error('title')
                            <p class="text-red-400 text-xs mt-1"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group m-3">
                        <input type="submit" class="btn btn-primary float-end" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    @endauth
@endsection
