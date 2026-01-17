@extends('layouts.app')

@section('content')
    <div class="text-center py-5">
        <h1 class="display-6">Welcome to FoodDrop</h1>
        <p class="text-muted">Discover restaurants, add items to your cart, and track your orders.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Browse Restaurants</a>
    </div>
@endsection
