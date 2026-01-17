@extends('layouts.app')

@section('content')
    <div class="row g-4">
        <div class="col-lg-7">
            <h1 class="h4 mb-3">Checkout</h1>
            <form method="POST" action="{{ route('orders.store') }}" class="card">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Delivery Address</label>
                        <input type="text" name="delivery_address" class="form-control" value="{{ old('delivery_address') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes (optional)</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Place Order</button>
                </div>
            </form>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($cart['items'] as $item)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <div class="fw-semibold">{{ $item['name'] }}</div>
                                    <small class="text-muted">Qty {{ $item['qty'] }}</small>
                                </div>
                                <span>${{ number_format($item['subtotal'], 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-between mt-3">
                        <span>Total</span>
                        <span class="fw-semibold">${{ number_format($cart['total'], 2) }}</span>
                    </div>
                    <div class="alert alert-warning mt-3 mb-0">
                        Cash on delivery only.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
