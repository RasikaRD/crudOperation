<div class="header-bottom  sticky-bar">
    <div class="container">
        <div class="header-wrap header-space-between ">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-light  py-2">
                <!-- Container wrapper -->
                <div class="container">
                    <!-- Navbar brand -->
                    <h5 class="nav-logo w-80">TODO APP</h5>

                    <!-- Toggle button -->
                    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                        data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fas1 fa-bars"></i>
                    </button>

                    <!-- Collapsible wrapper -->
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        <!-- Left links -->
                        @auth
                            <ul class="navbar-nav me-3">
                                <li class="nav-item">
                                    <a class="nav-link active d-flex align-items-center" aria-current="page"
                                        href="/"><i class="fas fa-bars pe-2"></i>HOME</a>
                                </li>

                                <!-- Left links -->


                                <li class="nav-item dropdown">
                                    {{-- <a class="nav-link dropdown-toggle active d-flex align-items-center" href="add"> --}}
                                    <a class="nav-link dropdown-toggle active d-flex align-items-center" href="add"
                                        id="todosDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fas1 fa-plus pe-1"></i>TODOS</a>

                                    <ul class="dropdown-menu dropdown-menu cards" aria-labelledby="todosDropdown">
                                        <div>

                                            <li>
                                                <a class="dropdown-item" href="add"><span class="fa-li pe-2"><i
                                                            class="fas fa-add"></i></span>
                                                    Add TODO</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="add"><span class="fa-li pe-2"><i
                                                            class="fas fa-user-friends"></i></span>Collaborators</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#"><span class="fa-li pe-2"><i
                                                            class="fas fa-building"></i></span>To Complete</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#"><span class="fa-li pe-2"><i
                                                            class="fas fa-key"></i></span>Completed Todos</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">

                                    {{-- <form class="d-flex align-items-center form-search ml-5">
                            <div class="input-group">
                                <button class="btn btn-light dropdown-toggle shadow-0 " type="button"
                                    data-mdb-toggle="dropdown" aria-expanded="false">
                                    All
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark fa-ul">
                                    <li>
                                        <a class="dropdown-item " href="#"><span class="fa-li pe-2"><i
                                                    class="fas fas1 fa-search"></i></span>All</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"><span class="fa-li pe-2"><i
                                                    class="fas fa-search-plus"></i></span>Advanced
                                            search<i class="fas fa-chevron-right ps-2"></i></a>
                                    </li>
                                </ul>
                                <input type="search" class="form-control" placeholder="Search" aria-label="Search" />
                            </div>
                            <a href="#!" class="text-white"><i class="fas fas1  fa-search ps-1 "></i></a>
                            </form> --}}
                                    @can('admin')
                                        <!-- Notifications -->
                                        <div class="dropdown" id="app">
                                            <button class="btn btn-light dropdown-toggle   " type="button"
                                                id="dropdownMenuButton2" data-bs-toggle="dropdown" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fas fa-bell"></i>
                                                @if (count(auth()->user()->unreadNotifications) == 0)
                                                    <span class="badge rounded-pill badge-notification bg-danger ml-1 "
                                                        id="count"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2"
                                                id="notificationArea">
                                                <li><a class="dropdown-item" href="#" id="notification">No
                                                        notifications!</a>
                                                </li>
                                                @endif

                                                <span class="badge rounded-pill badge-notification bg-danger ml-1 "
                                                    id="count">{{ count(auth()->user()->unreadNotifications) }}</span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-dark"
                                                    aria-labelledby="dropdownMenuButton2" id="notificationArea">

                                                    @if (count(auth()->user()->unreadNotifications) > 0)
                                                        @foreach (auth()->user()->unreadNotifications as $notification)
                                                            <li><a class="dropdown-item"
                                                                    href="/admin/notification/{{ $notification->id }}"
                                                                    id="notification">
                                                                    "{{ $notification->data['message'] }}"
                                                                    added by {{ $notification->data['username'] }}

                                                                </a></li>
                                                        @endforeach
                                                    @else
                                                        {{-- <li><a class="dropdown-item" id="notification">No notifications!</a></li> --}}
                                                </ul>
                                                @endif
                                            </ul>
                                        </div>
                                    @endcan

                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle active d-flex align-items-center" href="#"
                                        id="profiledropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{-- <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false"> --}}

                                        {{-- <i class="fa fas1 fa-user-circle" aria-hidden="true"></i> --}}
                                        @if (auth()->user()->name == 'admins')
                                            <span class=" uppercase"> {{ auth()->user()->name }}</span>
                                        @else
                                            <span class=" uppercase"> {{ auth()->user()->name }}</span>
                                        @endif
                                    </a>
                                    {{-- </button> --}}

                                    @can('admin')
                                        <ul class="dropdown-menu cards" aria-labelledby="profiledropdown">
                                            <li><a class="dropdown-item " href="/admin/todos">Admin</a></li>
                                        </ul>
                                    @endcan
                                    <ul class="dropdown-menu cards" aria-labelledby="profiledropdown">
                                        <li><a class="dropdown-item " href="/profile"><i class="fa fa-user-circle fas1" ></i> Profile</a></li>
                                        <li><a class="dropdown-item " href="#">Todo list</a></li>


                                    </ul>


                                </li>


                                <li class="nav-item ml-2">
                                    <form action="/logout" method="POST">
                                        @csrf

                                        <button type="submit"
                                            class="nav-link active d-flex align-items-center">LOGOUT</button>
                                    </form>
                                </li>
                            @else
                                <a class="nav-link active d-flex align-items-center" href="/register">REGISTER</a>

                                <a class="nav-link active d-flex align-items-center" href="/login">LOG IN</a>

                            @endauth
                        </ul>
                    </div>
                    <!-- Collapsible wrapper -->
                </div>
                <!-- Container wrapper -->
            </nav>
            <!-- Navbar -->
        </div>
    </div>
</div>
