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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- MDBootstrap -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->


    {{-- pusher cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>


    {{-- Realtime notification --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/js/app.js')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => ('csrf_token')(),
        ]) !!};
    </script>
    <script>
        $(document).ready(function() {
            $('nav ul li').hover(function() {
                $(this).find('ul').stop().slideDown();
            }, function() {
                $(this).find('ul').stop().slideUp();
            });
        });

        // Initialize the hamburger menu toggle
        $(document).ready(function() {
            $('.navbar-toggler').click(function() {
                $(this).toggleClass('collapsed');
                $('.navbar-collapse').toggleClass('show');
            });
        });
    </script>

    @can('admin')
        {{-- @vite('resources/js/app.js') --}}
        {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @endcan

</head>

<body>

    @extends('layouts.navbar')

    @extends('layouts.oldnavbar')

    <div class="container1 col-12 align-self-center">
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
                class="alert alert-success w-45 mt-3 align-self-center">
                {{ session()->get('success') }}
            </div>
        @endif
        @yield('content')
    </div>

    {{-- sticky-bar --}}
    <script>
        window.addEventListener('scroll', function() {

            var stickyBar = document.getElementById('sticky-bar');
            if (!stickyBar.classList.contains('stick')) {
                stickyBar.style.display = 'block';
                window.removeEventListener('scroll', arguments.callee);
            }
        });

        function toggleStickClass() {

            var stickyBar = document.getElementById('sticky-bar');
            console.log('toggleStickClass called');
            if (window.pageYOffset > 1) {
                stickyBar.classList.add('stick');
                console.log('stick class added');
            } else {
                stickyBar.classList.remove('stick');
                console.log('stick class removed');
            }
        }

        window.addEventListener('scroll', toggleStickClass);
    </script>

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
