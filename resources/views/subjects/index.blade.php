@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-uppercase text-muted small mb-1">CRUD menü</p>
            <h1 class="h4 fw-bold mb-0">Vizsgatárgyak karbantartása</h1>
        </div>
        @auth
            @if (auth()->user()->isAdmin())
                <a href="{{ route('subjects.create') }}" class="btn btn-primary">Új tantárgy</a>
            @endif
        @endauth
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Név</th>
                        <th>Szóbeli max.</th>
                        <th>Írásbeli max.</th>
                        <th>Vizsgák száma</th>
                        @auth
                            @if (auth()->user()->isAdmin())
                                <th class="text-end">Műveletek</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->oral_max }}</td>
                            <td>{{ $subject->written_max }}</td>
                            <td>{{ $subject->exams_count }}</td>
                            @auth
                                @if (auth()->user()->isAdmin())
                                    <td class="text-end">
                                        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-outline-primary">Szerkesztés</a>
                                        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Biztosan törlöd?')">Törlés</button>
                                        </form>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $subjects->links() }}
        </div>
    </div>
@endsection
