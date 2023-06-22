<nav class="navbar navbar-light bg-dark" id="sticky-bar">
    <div class="container">
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
                        <ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton2"
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
                        data-bs-toggle="dropdown" aria-expanded="false" href="/profile">
                        <i class="fa fa-user-circle" aria-hidden="true"></i> {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                    </ul>
                    @can('admin')
                        <ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton1">
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