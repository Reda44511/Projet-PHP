@php
    $currentImage = null;
    if (isset($restaurant) && $restaurant->image_path && Storage::disk('public')->exists($restaurant->image_path)) {
        $currentImage = Storage::disk('public')->url($restaurant->image_path);
    }
@endphp
<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $restaurant->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $restaurant->description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Category</label>
    <input type="text" name="category" class="form-control" value="{{ old('category', $restaurant->category ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Logo / Image</label>
    <input type="file" name="image" class="form-control">
    @if($currentImage)
        <div class="mt-2">
            <img src="{{ $currentImage }}" alt="{{ $restaurant->name }}" style="height: 80px;" class="rounded">
        </div>
    @endif
</div>
<div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" @checked(old('is_active', $restaurant->is_active ?? true))>
    <label class="form-check-label" for="is_active">Active</label>
</div>
