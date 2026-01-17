@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1">Find your next meal</h1>
            <p class="text-muted mb-0">Browse local restaurants and add items to your cart.</p>
        </div>
        <span class="badge bg-warning text-dark mt-3 mt-lg-0">Cash on delivery</span>
    </div>

    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-6">
            <label class="form-label">Search</label>
            <input type="text" name="search" class="form-control" placeholder="Restaurant name" value="{{ $search }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Category</label>
            <select name="category" class="form-select">
                <option value="">All categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" @selected($category === $cat)>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <label class="form-label">&nbsp;</label>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    @if($restaurants->count() === 0)
        <div class="alert alert-info">No restaurants found. Try a different search.</div>
    @else
        <div class="row g-4">
            @foreach($restaurants as $restaurant)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 card-hover">
                        @php
                            $imageUrl = $restaurant->image_path && Storage::disk('public')->exists($restaurant->image_path)
                                ? Storage::disk('public')->url($restaurant->image_path)
                                : asset('images/placeholder.svg');
                        @endphp
                        <img src="{{ $imageUrl }}" class="card-img-top" alt="{{ $restaurant->name }}" style="height: 180px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="card-title mb-1">{{ $restaurant->name }}</h5>
                                    <small class="text-muted">{{ $restaurant->category ?? 'General' }}</small>
                                </div>
                                <span class="badge bg-light text-dark">Open</span>
                            </div>
                            <p class="card-text mt-3 text-muted">{{ Str::limit($restaurant->description, 120) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('restaurants.show', $restaurant) }}" class="btn btn-outline-primary w-100">View Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $restaurants->links() }}
        </div>
    @endif
@endsection
