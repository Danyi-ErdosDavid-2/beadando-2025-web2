@extends('layouts.app')

@section('content')
    <section class="row g-4 align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="display-4 fw-bold mb-3">VizsgaPortál – Érettségi statisztikák egy helyen</h1>
            <p class="lead">A beadandó alkalmazás a Web-programozás-2 elméleti anyaga alapján készült, MVC architektúrával,
                ORM-mel és reszponzív felülettel. A látogatók áttekinthetik az érettségi adatbázist, üzenetet küldhetnek,
                a regisztrált felhasználók pedig extra funkciókhoz férnek hozzá.</p>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('exams.index') }}" class="btn btn-primary btn-lg rounded-pill">Adatbázis böngészése</a>
                <a href="{{ route('diagram.index') }}" class="btn btn-outline-primary btn-lg rounded-pill">Diagram megtekintése</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="glass-card p-4">
                <h2 class="h4 mb-3">Gyorselemzés</h2>
                <div class="row text-center g-3">
                    <div class="col-4">
                        <p class="display-5 fw-bold text-primary mb-0">{{ number_format($stats['students']) }}</p>
                        <p class="text-muted small text-uppercase">Vizsgázó</p>
                    </div>
                    <div class="col-4">
                        <p class="display-5 fw-bold text-primary mb-0">{{ number_format($stats['subjects']) }}</p>
                        <p class="text-muted small text-uppercase">Tantárgy</p>
                    </div>
                    <div class="col-4">
                        <p class="display-5 fw-bold text-primary mb-0">{{ number_format($stats['exams']) }}</p>
                        <p class="text-muted small text-uppercase">Értékelés</p>
                    </div>
                </div>
                <p class="mb-0 text-muted small mt-3">Az adatok a 2-02 Érettségi háromtáblás adatbázisból származnak.</p>
            </div>
        </div>
    </section>

    <section class="row g-4 mb-5">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h3 class="card-title h5 text-uppercase text-muted">Legnépszerűbb vizsgatárgyak</h3>
                    <ul class="list-group list-group-flush mt-3">
                        @foreach ($topSubjects as $subject)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $subject->name }}</span>
                                <span class="badge text-bg-primary rounded-pill">{{ $subject->exams_count }} vizsga</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h3 class="card-title h5 text-uppercase text-muted">Top 5 vizsgaeredmény</h3>
                    <div class="table-responsive mt-3">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>Név</th>
                                    <th>Tantárgy</th>
                                    <th class="text-end">Összpont</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topResults as $exam)
                                    <tr>
                                        <td>{{ $exam->student->name }}</td>
                                        <td>{{ $exam->subject->name }}</td>
                                        <td class="text-end fw-bold">{{ $exam->total_points }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="info-blurb">
                    <h4>Autentikáció</h4>
                    <p>Regisztráció, belépés és szerepkör alapú jogosultságok biztosítják, hogy az Üzenetek és Admin menük csak
                        a megfelelő felhasználóknak legyenek láthatók.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-blurb">
                    <h4>ORM + Migrációk</h4>
                    <p>Eloquent modellek és migrációk kezelik a vizsgázók, tantárgyak, vizsgák és üzenetek táblákat, seedelve a
                        forrás TXT fájlokból.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-blurb">
                    <h4>Kapcsolat + CRUD</h4>
                    <p>Űrlap validáció, üzenetek mentése, Chart.js diagram és egy teljes CRUD felület gondoskodik a
                        beadandó követelményekről.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
