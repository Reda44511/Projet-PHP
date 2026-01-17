@extends('layouts.app')

@section('content')
    <h1 class="h4 mb-3">Edit Menu Item</h1>

    <form method="POST" action="{{ route('admin.menu-items.update', $menuItem) }}" enctype="multipart/form-data" class="card">
        @csrf
        @method('PUT')
        <div class="card-body">
            @include('admin.menu-items._form', ['menuItem' => $menuItem])
            <button class="btn btn-primary" type="submit">Save Changes</button>
            <a href="{{ route('admin.menu-items.show', $menuItem) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection
