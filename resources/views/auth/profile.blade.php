@extends('layouts.layout')
@section('title')
    Profile Details
@endsection
@section('content')
<div class="container">
    <div class="max-w-lg mx-auto mt-40  bg-gray-100 border boder-gray-200 p-4 rounded-xl">

        <h2 class="text-center font-blod text-xl">Profile Details</h2>
        <div class="mb-2 mt-3">
            <label class="blcok mb-2 upercase font-bold" for="name">Name : </label>
            <label class="blcok mb-2 upercase font-bold" for="name">{{ $user->name }}</label>
        </div>
        <div class="mb-2">
            <label class="blcok mb-2 upercase font-bold" for="name">Email : </label>
            <label class="blcok mb-2 upercase font-bold" for="name">{{ $user->email }}</label>
        </div>
        <div class="mb-2">
            <label class="blcok mb-2 upercase font-bold" for="name">Username : </label>
            <label class="blcok mb-2 upercase font-bold" for="name">{{ $user->username }}</label>
        </div>
        <div class="mb-2">
            <label class="blcok mb-2 upercase font-bold" for="name">Todo count : </label>
            <label class="blcok mb-2 upercase font-bold" for="name"></label>
        </div>
    </div>
</div>
@endsection