@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h4 mb-1">{{ $restaurant->name }}</h1>
            <small class="text-muted">{{ $restaurant->category ?? 'General' }}</small>
        </div>
        <div>
            <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="btn btn-outline-secondary">Edit</a>
            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-outline-primary">Back</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            @php
                $imageUrl = $restaurant->image_path && Storage::disk('public')->exists($restaurant->image_path)
                    ? Storage::disk('public')->url($restaurant->image_path)
                    : asset('images/placeholder.svg');
            @endphp
            <img src="{{ $imageUrl }}" alt="{{ $restaurant->name }}" class="img-fluid rounded mb-3" style="max-height: 240px; object-fit: cover; width: 100%;">
            <p>{{ $restaurant->description }}</p>
            <span class="badge {{ $restaurant->is_active ? 'bg-success' : 'bg-secondary' }}">
                {{ $restaurant->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
    </div>

    <h2 class="h5">Menu Items</h2>
    @if($restaurant->menuItems->isEmpty())
        <div class="alert alert-info">No menu items yet.</div>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($restaurant->menuItems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>
                            @if($item->is_available)
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-secondary">Unavailable</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
