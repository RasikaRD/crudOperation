<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        @yield('title')
    </title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>

    <nav class="navbar navbar-light bg-dark">
        <div class="container mb-0 h1 align-self-center">
            <a href="/"><span class="btn btn-primary  mb-2 ml-2"> HOME</span></a>
            <div class="flex align-self-center">
                @auth
                    <span class="text-gray-100 text-base font-bold uppercase py-3 px-5 ml-3"> Welcome, {{ auth()->user()->name }}</span>
                    <form action="/logout" method="POST" >
                        @csrf
                        <button type="submit" class="btn btn-info  mb-2 ml-2">LOG OUT</button>
                    </form>
                    @else
                    <a href="/register"><span class="btn btn-primary  mb-2 ml-2">REGISTER</span></a>
                    <a href="/login"><span class="btn btn-info  mb-2 ml-2">LOG IN</span></a>
                    @endauth
            </div>
        </div>
    </nav>
    <div class="container w-75 align-self-center">
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                class="alert alert-success w-45 mt-3 align-self-center">
                {{ session()->get('success') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
