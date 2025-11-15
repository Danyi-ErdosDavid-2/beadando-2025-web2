@extends('layouts.app')

@section('content')
    <div class="row g-4">
        <div class="col-lg-6">
            <h1 class="h3 fw-bold mb-3">Kapcsolatfelvétel</h1>
            <p class="text-muted">Az üzenetküldő űrlap szerver oldali validációt használ. Az elküldött adatok a
                regisztrált látogatók által megtekinthető Üzenetek menübe kerülnek.</p>
            <ul class="list-unstyled">
                <li class="mb-2"><strong>E-mail:</strong> info@vizsgaportal.hu</li>
                <li class="mb-2"><strong>Telefon:</strong> +36 30 123 4567</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <form method="POST" action="{{ route('contact.store') }}" class="card border-0 shadow-sm p-4">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Név</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Téma</label>
                    <input type="text" name="topic" value="{{ old('topic') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Üzenet</label>
                    <textarea name="content" rows="5" class="form-control" required>{{ old('content') }}</textarea>
                </div>
                <button class="btn btn-primary w-100">Üzenet küldése</button>
            </form>
        </div>
    </div>
@endsection
