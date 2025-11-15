@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <h1 class="h4 fw-bold mb-4 text-center">Bejelentkezés</h1>
            <form method="POST" action="{{ route('login.store') }}" class="card border-0 shadow-sm p-4">
                @csrf
                <div class="mb-3">
                    <label class="form-label">E-mail cím</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jelszó</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
                    <label class="form-check-label" for="remember">
                        Jegyezzen meg
                    </label>
                </div>
                <button class="btn btn-primary w-100">Belépés</button>
            </form>
        </div>
    </div>
@endsection
