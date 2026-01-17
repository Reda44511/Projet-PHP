@extends('layouts.app')

@section('content')
    <h1 class="h4 mb-3">Orders</h1>

    @if($orders->count() === 0)
        <div class="alert alert-info">No orders yet.</div>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Restaurant</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Placed</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user?->name }}</td>
                        <td>{{ $order->restaurant?->name }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span></td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    @endif
@endsection
