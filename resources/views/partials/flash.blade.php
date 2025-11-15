@if (session('status'))
    <div class="alert alert-success rounded-4 shadow-sm mb-4">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger rounded-4 shadow-sm mb-4">
        <p class="fw-bold mb-2">Hoppá! Valami nem stimmel:</p>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
