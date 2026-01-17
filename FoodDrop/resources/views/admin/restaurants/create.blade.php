@extends('layouts.app')

@section('content')
    <h1 class="h4 mb-3">Add Restaurant</h1>

    <form method="POST" action="{{ route('admin.restaurants.store') }}" enctype="multipart/form-data" class="card">
        @csrf
        <div class="card-body">
            @include('admin.restaurants._form')
            <button class="btn btn-primary" type="submit">Create Restaurant</button>
            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection
