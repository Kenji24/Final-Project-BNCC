<!-- resources/views/partials/header.blade.php -->

<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">CUNNY STORE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link mx-2 {{request()->routeIs('home') ? 'active' : ''}}" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 {{request()->routeIs('product.menu') ? 'active' : ''}}" href="{{ route('product.menu') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 {{request()->routeIs('about') ? 'active' : ''}}" href="{{ route('about') }}">About Us</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <a href="{{ route('cart') }}"><button class="me-2 BtnIcon"><i class="bi bi-cart-dash"></i></button></a>
                @auth
                    <a href="{{ route('invoice') }}"><button class="me-2 BtnIcon"><i class="bi bi-receipt-cutoff"></i></button></a>
                    <div id="hoverArea" class="hover-area"><p class="pe-2 mb-0">Hello, {{ Auth::user()->firstName }}</p></div>
                    <form action="{{ route('user.logout') }}" method="POST">
                        @csrf
                        <button class="secondaryBtn">Log out</button>
                    </form>
                @else
                    <button onclick="window.location.href='{{ route('login') }}'" class="me-2 primaryBtn">Login</button>
                    <button onclick="window.location.href='{{ route('register') }}'"  class="secondaryBtn">Sign in</button>
                @endauth
            </div>
        </div>
    </div>
</nav>
