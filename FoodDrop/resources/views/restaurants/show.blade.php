@extends('layouts.app')

@section('content')
    <div class="row g-4 align-items-center mb-4">
        <div class="col-lg-5">
            @php
                $imageUrl = $restaurant->image_path && Storage::disk('public')->exists($restaurant->image_path)
                    ? Storage::disk('public')->url($restaurant->image_path)
                    : asset('images/placeholder.svg');
            @endphp
            <img src="{{ $imageUrl }}" alt="{{ $restaurant->name }}" class="img-fluid rounded" style="width: 100%; max-height: 260px; object-fit: cover;">
        </div>
        <div class="col-lg-7">
            <h1 class="h3">{{ $restaurant->name }}</h1>
            <p class="text-muted mb-1">{{ $restaurant->category ?? 'General' }}</p>
            <p class="mb-0">{{ $restaurant->description }}</p>
        </div>
    </div>

    <h2 class="h4 mb-3">Menu</h2>

    @if($menuItems->isEmpty())
        <div class="alert alert-info">This restaurant has no available items right now.</div>
    @else
        <div class="row g-4">
            @foreach($menuItems as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 card-hover">
                        @php
                            $itemImage = $item->image_path && Storage::disk('public')->exists($item->image_path)
                                ? Storage::disk('public')->url($item->image_path)
                                : asset('images/placeholder.svg');
                        @endphp
                        <img src="{{ $itemImage }}" class="card-img-top" alt="{{ $item->name }}" style="height: 160px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="text-muted">{{ $item->description ?? 'Freshly prepared for you.' }}</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold">${{ number_format($item->price, 2) }}</span>
                                    <form method="POST" action="{{ route('cart.add') }}" class="d-flex align-items-center gap-2">
                                        @csrf
                                        <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                                        <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm" style="width: 70px;">
                                        <button class="btn btn-sm btn-primary" type="submit">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
