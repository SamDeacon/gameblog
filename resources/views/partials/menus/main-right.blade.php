@if (Route::has('login'))
    <ul class="navbar-nav right-links">
            @auth
            <li class="nav-item"><a class="nav-link" href="{{ url('#') }}">Messages</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
        @else
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @endauth
    </ul>
@endif