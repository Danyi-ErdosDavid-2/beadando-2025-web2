@extends('layouts.app')

@section('content')
    <div class="col-lg-6 mx-auto">
        <h1 class="h4 fw-bold mb-4">Vizsgatárgy szerkesztése</h1>
        <form method="POST" action="{{ route('subjects.update', $subject) }}" class="card border-0 shadow-sm p-4">
            @method('PUT')
            @include('subjects.form', ['buttonLabel' => 'Mentés', 'subject' => $subject])
        </form>
    </div>
@endsection
