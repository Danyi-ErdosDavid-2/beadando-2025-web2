<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'VizsgaPortal') }}</title>
        <link rel="preconnect" href="https://cdn.jsdelivr.net">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @stack('styles')
    </head>
    <body>
        <header class="shadow-sm">
            <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between py-3">
                <a href="{{ route('home') }}" class="navbar-brand fw-bold fs-3 text-primary">{{ config('app.name') }}</a>
                <nav class="nav gap-3 text-uppercase small fw-semibold">
                    <a class="nav-link{{ request()->routeIs('home') ? ' active' : '' }}" href="{{ route('home') }}">Főoldal</a>
                    <a class="nav-link{{ request()->routeIs('exams.*') ? ' active' : '' }}" href="{{ route('exams.index') }}">Adatbázis</a>
                    <a class="nav-link{{ request()->routeIs('diagram.*') ? ' active' : '' }}" href="{{ route('diagram.index') }}">Diagram</a>
                    <a class="nav-link{{ request()->routeIs('subjects.*') ? ' active' : '' }}" href="{{ route('subjects.index') }}">CRUD</a>
                    <a class="nav-link{{ request()->routeIs('contact.*') ? ' active' : '' }}" href="{{ route('contact.form') }}">Kapcsolat</a>
                    @auth
                        <a class="nav-link{{ request()->routeIs('messages.*') ? ' active' : '' }}" href="{{ route('messages.index') }}">Üzenetek</a>
                        @if(auth()->user()->isAdmin())
                            <a class="nav-link{{ request()->routeIs('admin.*') ? ' active' : '' }}" href="{{ route('admin.dashboard') }}">Admin</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm ms-2">Kijelentkezés</button>
                        </form>
                    @else
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Belépés</a>
                        @if (config('app.allow_registration'))
                            <a class="btn btn-primary btn-sm ms-2" href="{{ route('register') }}">Regisztráció</a>
                        @endif
                    @endauth
                </nav>
            </div>
        </header>

        <main class="py-4">
            <div class="container">
                @include('partials.flash')
                @yield('content')
            </div>
        </main>

        <footer class="bg-dark text-white py-4 mt-5">
            <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="mb-0">&copy; {{ date('Y') }} VizsgaPortál – Laravel alapú beadandó.</p>
                <p class="mb-0 small text-white-50">Követi a Web-programozás-2 előadás tematikáját.</p>
            </div>
        </footer>
        @stack('scripts')
    </body>
</html>
