@extends('layouts.app')

@section('content')
    <div class="col-lg-6 mx-auto">
        <h1 class="h4 fw-bold mb-4">Új vizsgatárgy felvétele</h1>
        <form method="POST" action="{{ route('subjects.store') }}" class="card border-0 shadow-sm p-4">
            @include('subjects.form', ['buttonLabel' => 'Létrehozás', 'subject' => null])
        </form>
    </div>
@endsection
