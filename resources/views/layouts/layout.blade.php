<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    {{-- Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/js/app.js')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => ('csrf_token')(),
        ]) !!};
    </script>

    @can('admin')
        {{-- @vite('resources/js/app.js') --}}
        {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @endcan

</head>

<body>

    <nav class="navbar navbar-light bg-dark">
        <div class="container mb-0 h1 align-self-center">
            <a href="/"><span class="btn btn-secondary  mb-2 ml-2"> HOME</span></a>
            <div class="flex align-self-center">
                @auth
                    {{-- <span class="text-gray-100 text-base font-bold uppercase py-3 px-5 ml-3">
                        <i class="fa fa-user-circle" aria-hidden="true"></i> {{ auth()->user()->name }}</span> --}}

                    @can('admin')
                        <!-- Notifications -->
                        <div class="dropdown" id="app">
                            <button class="btn btn-secondary dropdown-toggle  mb-1 mr-2 " type="button"
                                id="dropdownMenuButton2" data-bs-toggle="dropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                {{-- @if (count(auth()->user()->unreadNotifications) == 0)
                                    <span class="badge rounded-pill badge-notification bg-danger ml-1 " id="count"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2" 
                            id="notificationArea">
                                <li><a class="dropdown-item" href="#" id="notification">No notifications!</a>
                                </li>
                                @endif --}}
                                
                                <span class="badge rounded-pill badge-notification bg-danger ml-1 "
                                    id="count">{{ count(auth()->user()->unreadNotifications) }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2"
                                id="notificationArea">

                                @if (count(auth()->user()->unreadNotifications) > 0)
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                        <li><a class="dropdown-item" href="/admin/notification/{{ $notification->id }}"
                                                id="notification">
                                                "{{ $notification->data['message'] }}"
                                                added by {{ $notification->data['username'] }}

                                            </a></li>
                                    @endforeach
                                @else
                                    {{-- <li><a class="dropdown-item" id="notification">No notifications!</a></li> --}}
                            </ul>
                            @endif
                        </div>
                    @endcan

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle mb-1" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user-circle" aria-hidden="true"></i> {{ auth()->user()->name }}
                        </button>
                        @can('admin')
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/admin/todos">Admin</a></li>
                            </ul>
                        @endcan
                    </div>

                    <form action="/logout" method="POST">
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

    {{-- script for notification --}}
    @can('admin')
        <script type="module">
        
        let notificationCount = {{ count(auth()->user()->unreadNotifications) }};
        window.Echo.private('App.Models.User.' + {{ auth()->user()->id }})
            .notification((notification) => {
                notificationCount++;
                document.getElementById('count').textContent = notificationCount;
                console.log(notification.type); 

                 // Display the notification message
                 if(notificationCount > 0){

                    let notificationList = document.getElementById("notificationArea");
                    let li = document.createElement('li');
                    if(notificationList){
                        
                        let a = document.createElement('a');
                        a.classList.add("dropdown-item");               
                        a.href = '/admin/notification/' + notification.id;
                        a.textContent = 'New Notification !';
                        li.appendChild(a);
                        notificationList.appendChild(li);

                    }
     
                }
            });
            
    </script>
    @endcan
    {{-- End Notification script --}}

</body>

</html>
