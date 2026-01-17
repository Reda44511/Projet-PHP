@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Restaurants</h1>
        <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary">Add Restaurant</a>
    </div>

    @if($restaurants->count() === 0)
        <div class="alert alert-info">No restaurants yet.</div>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($restaurants as $restaurant)
                    <tr>
                        <td>{{ $restaurant->name }}</td>
                        <td>{{ $restaurant->category ?? 'General' }}</td>
                        <td>
                            @if($restaurant->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $restaurant->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.restaurants.show', $restaurant) }}" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form method="POST" action="{{ route('admin.restaurants.destroy', $restaurant) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Delete this restaurant?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $restaurants->links() }}
        </div>
    @endif
@endsection
