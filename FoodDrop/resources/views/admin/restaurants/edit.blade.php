@extends('layouts.app')

@section('content')
    <h1 class="h4 mb-3">Edit Restaurant</h1>

    <form method="POST" action="{{ route('admin.restaurants.update', $restaurant) }}" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')
        <div class="card-body">
            @include('admin.restaurants._form', ['restaurant' => $restaurant])
            <button class="btn btn-primary" type="submit">Save Changes</button>
            <a href="{{ route('admin.restaurants.show', $restaurant) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection
