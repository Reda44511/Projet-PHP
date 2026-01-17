@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h4 mb-1">{{ $menuItem->name }}</h1>
            <small class="text-muted">{{ $menuItem->restaurant?->name }}</small>
        </div>
        <div>
            <a href="{{ route('admin.menu-items.edit', $menuItem) }}" class="btn btn-outline-secondary">Edit</a>
            <a href="{{ route('admin.menu-items.index') }}" class="btn btn-outline-primary">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @php
                $imageUrl = $menuItem->image_path && Storage::disk('public')->exists($menuItem->image_path)
                    ? Storage::disk('public')->url($menuItem->image_path)
                    : asset('images/placeholder.svg');
            @endphp
            <img src="{{ $imageUrl }}" alt="{{ $menuItem->name }}" class="img-fluid rounded mb-3" style="max-height: 200px; object-fit: cover; width: 100%;">
            <p>{{ $menuItem->description ?? 'No description provided.' }}</p>
            <p class="mb-1"><strong>Price:</strong> ${{ number_format($menuItem->price, 2) }}</p>
            <p class="mb-0">
                <strong>Status:</strong>
                <span class="badge {{ $menuItem->is_available ? 'bg-success' : 'bg-secondary' }}">
                    {{ $menuItem->is_available ? 'Available' : 'Unavailable' }}
                </span>
            </p>
        </div>
    </div>
@endsection
