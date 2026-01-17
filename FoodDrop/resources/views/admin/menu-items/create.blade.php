@extends('layouts.app')

@section('content')
    <h1 class="h4 mb-3">Add Menu Item</h1>

    <form method="POST" action="{{ route('admin.menu-items.store') }}" enctype="multipart/form-data" class="card">
        @csrf
        <div class="card-body">
            @include('admin.menu-items._form')
            <button class="btn btn-primary" type="submit">Create Menu Item</button>
            <a href="{{ route('admin.menu-items.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection
