<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        @yield('title')
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


</head>

<body>

    <nav class="navbar navbar-light bg-light">
        <div class="container mb-0 h1">
            <a href="/"><span class="btn btn-primary  mb-2 h1"> TO DO LIST</span></a>
        </div>
    </nav>

    <div class="container w-75 align-self-center">
        @if(session()->has('success'))
        <div class="alert alert-success  mt-5 align-self-center">
            {{ session()->get('success') }}
        </div>
        @endif
        @yield('content')

    </div>

</body>

</html>