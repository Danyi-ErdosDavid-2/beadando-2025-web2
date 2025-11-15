@csrf
@php($current = $subject ?? null)
<div class="mb-3">
    <label class="form-label">Név</label>
    <input type="text" name="name" value="{{ old('name', $current->name ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Szóbeli maximum</label>
    <input type="number" name="oral_max" value="{{ old('oral_max', $current->oral_max ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Írásbeli maximum</label>
    <input type="number" name="written_max" value="{{ old('written_max', $current->written_max ?? '') }}" class="form-control" required>
</div>
<button class="btn btn-primary">{{ $buttonLabel }}</button>
