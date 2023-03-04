@extends('layouts.layout')
@section('title')
Register
@endsection
@section('content')
<main class="max-w-lg mx-auto mt-8  bg-gray-100 border boder-gray-200 p-4 rounded-xl">

    <h2 class="text-center font-blod text-xl">Register !</h2>

    <form method="post" action="/register" class="mt-5">
        @csrf
        <div class="mb-2">
            <label class="blcok mb-2 upercase font-bold" for="name">Name</label>
            <input class="border border-gray-400 p-1 w-full rounded" 
            type="text" 
            name="name" 
            id="name" 
            value="{{ old('name') }}" 
                required>
                @error('name')
                <p class="text-red-500 text-xs mt-1"> {{ $message }}</p>
                @enderror
        </div>

        <div class="mb-2">
            <label class="blcok mb-2 upercase font-bold" for="username">Username</label>
            <input class="border border-gray-400 p-1 w-full rounded" 
            type="text" 
            name="username" 
            id="username"
            value="{{ old('username') }}" 
            required>
                @error('username')
                <p class="text-red-500 text-xs mt-1"> {{ $message }}</p>
                @enderror
        </div>

        <div class="mb-2">
            <label class="blcok mb-2 upercase font-bold" for="email">Email</label>
            <input class="border border-gray-400 p-1 w-full rounded" 
            type="text" 
            name="email"
            id="email"
            value="{{ old('email') }}" 
            required>
                @error('email')
                <p class="text-red-500 text-xs mt-1 mb-1"> {{ $message }}</p>
                @enderror
        </div>

        <div class="mb-2">
            <label class="blcok mb-2 upercase font-bold" for="password">Password</label>
            <input class="border border-gray-400 p-1 w-full rounded" 
            type="password" 
            name="password"
            id="password"
            value="{{ old('password') }}" 
            required>
            @error('password')
            <p class="text-red-500 text-xs mt-1"> {{ $message }}</p>
            @enderror
        </div>

        <div class="mb-2">
            <input type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" value="Submit">
        </div>

    </form>


</main>

@endsection