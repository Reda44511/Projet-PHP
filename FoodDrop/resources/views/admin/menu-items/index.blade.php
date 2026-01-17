@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Menu Items</h1>
        <a href="{{ route('admin.menu-items.create') }}" class="btn btn-primary">Add Menu Item</a>
    </div>

    @if($menuItems->count() === 0)
        <div class="alert alert-info">No menu items yet.</div>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Restaurant</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($menuItems as $menuItem)
                    <tr>
                        <td>{{ $menuItem->name }}</td>
                        <td>{{ $menuItem->restaurant?->name }}</td>
                        <td>${{ number_format($menuItem->price, 2) }}</td>
                        <td>
                            @if($menuItem->is_available)
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-secondary">Unavailable</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.menu-items.show', $menuItem) }}" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('admin.menu-items.edit', $menuItem) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form method="POST" action="{{ route('admin.menu-items.destroy', $menuItem) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Delete this menu item?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $menuItems->links() }}
        </div>
    @endif
@endsection
