@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-uppercase text-muted small mb-1">Üzenetek menü</p>
            <h1 class="h4 fw-bold mb-0">Beérkezett kontaktok</h1>
        </div>
        <p class="text-muted small mb-0">Csak regisztrált felhasználók láthatják.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Név</th>
                        <th>E-mail</th>
                        <th>Téma</th>
                        <th>Üzenet</th>
                        <th>Küldve</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->topic }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($message->content, 80) }}</td>
                            <td>{{ optional($message->submitted_at)->format('Y.m.d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
