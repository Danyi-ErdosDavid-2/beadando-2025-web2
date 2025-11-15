@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <p class="text-uppercase text-muted small mb-1">Adatbázis menü</p>
            <h1 class="h3 fw-bold mb-0">Vizsgaeredmények</h1>
        </div>
        <form method="GET" class="d-flex gap-2 flex-wrap align-items-end">
            <div>
                <label class="form-label small text-uppercase">Tantárgy</label>
                <select class="form-select" name="subject">
                    <option value="">Összes</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" @selected(request('subject') == $subject->id)>{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label small text-uppercase">Osztály</label>
                <input type="text" name="classroom" value="{{ request('classroom') }}" class="form-control" placeholder="pl. 12/A">
            </div>
            <div>
                <label class="form-label small text-uppercase">Név</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Keresés">
            </div>
            <button class="btn btn-primary">Szűrés</button>
        </form>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="text-muted small text-uppercase">
                    <tr>
                        <th>Vizsgázó</th>
                        <th>Osztály</th>
                        <th>Tantárgy</th>
                        <th class="text-end">Szóbeli</th>
                        <th class="text-end">Írásbeli</th>
                        <th class="text-end">Összpont</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exams as $exam)
                        <tr>
                            <td>{{ $exam->student->name }}</td>
                            <td>{{ $exam->student->classroom }}</td>
                            <td>{{ $exam->subject->name }}</td>
                            <td class="text-end">{{ $exam->oral_score }}</td>
                            <td class="text-end">{{ $exam->written_score }}</td>
                            <td class="text-end fw-bold">{{ $exam->oral_score + $exam->written_score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $exams->links() }}
        </div>
    </div>
@endsection
