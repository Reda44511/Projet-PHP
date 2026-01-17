@php
    $currentImage = null;
    if (isset($menuItem) && $menuItem->image_path && Storage::disk('public')->exists($menuItem->image_path)) {
        $currentImage = Storage::disk('public')->url($menuItem->image_path);
    }
@endphp
<div class="mb-3">
    <label class="form-label">Restaurant</label>
    <select name="restaurant_id" class="form-select" required>
        <option value="">Select a restaurant</option>
        @foreach($restaurants as $restaurant)
            <option value="{{ $restaurant->id }}" @selected(old('restaurant_id', $menuItem->restaurant_id ?? '') == $restaurant->id)>{{ $restaurant->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $menuItem->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $menuItem->description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number" name="price" step="0.01" min="0" class="form-control" value="{{ old('price', $menuItem->price ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Image</label>
    <input type="file" name="image" class="form-control">
    @if($currentImage)
        <div class="mt-2">
            <img src="{{ $currentImage }}" alt="{{ $menuItem->name }}" style="height: 80px;" class="rounded">
        </div>
    @endif
</div>
<div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" id="is_available" name="is_available" value="1" @checked(old('is_available', $menuItem->is_available ?? true))>
    <label class="form-check-label" for="is_available">Available</label>
</div>
