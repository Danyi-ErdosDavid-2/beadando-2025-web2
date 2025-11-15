@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <p class="text-uppercase text-muted small mb-1">Admin menü</p>
        <h1 class="h4 fw-bold mb-0">Rendszer áttekintése</h1>
    </div>

    <div class="row g-3 mb-4">
        @foreach ($stats as $label => $value)
            <div class="col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <p class="text-muted text-uppercase small mb-1">{{ ucfirst($label) }}</p>
                        <p class="display-6 fw-bold text-primary mb-0">{{ number_format($value) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h2 class="h5 mb-3">Felhasználói szerepkörök</h2>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Név</th>
                            <th>E-mail</th>
                            <th>Szerep</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge rounded-pill text-bg-{{ $user->isAdmin() ? 'primary' : 'secondary' }}">
                                        {{ $user->role === 'admin' ? 'Admin' : 'Regisztrált látogató' }}
                                    </span>
                                </td>
                                <td>
                                    @if (auth()->id() !== $user->id)
                                        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="d-flex gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="form-select form-select-sm w-auto">
                                                <option value="registered" @selected($user->role === 'registered')>Regisztrált</option>
                                                <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                            </select>
                                            <button class="btn btn-sm btn-outline-primary">Mentés</button>
                                        </form>
                                    @else
                                        <span class="text-muted small">Saját profil</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
