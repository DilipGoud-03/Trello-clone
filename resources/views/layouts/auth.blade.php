<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trello </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container ">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ">
                    @if(auth()->user())
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}" href="{{route('dashboard')}}">Boards</a>
                    </li>
                </ul>
                <ul class="navbar-nav " style="margin-left: auto">
                    <li>
                        <a class=" nav-link {{ (request()->is('logout')) ? 'active' : '' }}">{{auth()->user()->name}}</a>
                    </li>
                </ul>
                <ul class="navbar-nav " style="margin-left: auto">
                    <li>
                        <a class=" nav-link {{ (request()->is('logout')) ? 'active' : '' }}" href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    @else
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{url('/')}}">Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav " style="margin-left: auto">
                    <li class="nav-item-flex-right">
                        <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main class="mt-3">
        @yield('content')
    </main>
</body>

</html>