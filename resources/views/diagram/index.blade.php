@extends('layouts.app')

@section('content')
    <div class="row g-4 align-items-center mb-4">
        <div class="col-lg-5">
            <h1 class="h3 fw-bold mb-3">Diagram menü</h1>
            <p>A diagram a vizsgatárgyak átlagos pontszámát jeleníti meg Chart.js segítségével. Az adatok dinamikusan
                kerülnek lekérésre az `diagram/adatok` útvonalról.</p>
            <ul class="text-muted small">
                <li>Laravel Controller JSON adatforrással</li>
                <li>Chart.js 4-es verzió CDN-ről</li>
                <li>Reszponzív vászon és sötét-világos színek</li>
            </ul>
        </div>
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4">
                <canvas id="subjects-chart" height="200"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const ctx = document.getElementById('subjects-chart').getContext('2d');
            const response = await fetch('{{ route('diagram.data') }}');
            const dataset = await response.json();
            const colors = ['#2563eb', '#0ea5e9', '#22c55e', '#f97316', '#e11d48', '#a21caf', '#0f172a'];

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dataset.map(item => item.subject),
                    datasets: [{
                        label: 'Átlagpont',
                        data: dataset.map(item => item.average),
                        backgroundColor: colors,
                        borderRadius: 12,
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 10 },
                            title: { display: true, text: 'Pontszám' },
                        },
                    },
                },
            });
        });
    </script>
@endpush
