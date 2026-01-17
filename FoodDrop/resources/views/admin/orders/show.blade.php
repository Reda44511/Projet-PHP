@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h4 mb-1">Order #{{ $order->id }}</h1>
            <small class="text-muted">{{ $order->restaurant?->name }} • {{ $order->user?->name }}</small>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Items</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($order->items as $item)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <div class="fw-semibold">{{ $item->menuItem?->name }}</div>
                                    <small class="text-muted">Qty {{ $item->quantity }}</small>
                                </div>
                                <span>${{ number_format($item->line_total, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-between mt-3">
                        <span>Total</span>
                        <span class="fw-semibold">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Delivery Details</h5>
                    <p class="mb-1"><strong>Address:</strong> {{ $order->delivery_address }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                    @if($order->notes)
                        <p class="mb-0"><strong>Notes:</strong> {{ $order->notes }}</p>
                    @else
                        <p class="text-muted mb-0">No delivery notes.</p>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Status</h5>
                    <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <select name="status" class="form-select">
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" @selected($order->status === $status)>
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
