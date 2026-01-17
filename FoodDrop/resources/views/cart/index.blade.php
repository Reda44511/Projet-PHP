@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h4 mb-1">Your Cart</h1>
            @if($restaurant)
                <small class="text-muted">Restaurant: {{ $restaurant->name }}</small>
            @endif
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Continue Shopping</a>
    </div>

    @if(empty($cart['items']))
        <div class="alert alert-info">Your cart is empty. Add items from a restaurant to get started.</div>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th style="width: 140px;">Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cart['items'] as $itemId => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.update') }}" class="d-flex gap-2">
                                @csrf
                                <input type="hidden" name="menu_item_id" value="{{ $itemId }}">
                                <input type="number" name="quantity" min="1" value="{{ $item['qty'] }}" class="form-control form-control-sm">
                                <button class="btn btn-sm btn-outline-primary" type="submit">Update</button>
                            </form>
                        </td>
                        <td>${{ number_format($item['subtotal'], 2) }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.remove') }}">
                                @csrf
                                <input type="hidden" name="menu_item_id" value="{{ $itemId }}">
                                <button class="btn btn-sm btn-outline-danger" type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            <div class="card" style="min-width: 260px;">
                <div class="card-body">
                    <h5 class="card-title">Summary</h5>
                    <div class="d-flex justify-content-between">
                        <span>Total</span>
                        <span class="fw-semibold">${{ number_format($cart['total'], 2) }}</span>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-primary w-100 mt-3">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    @endif
@endsection
