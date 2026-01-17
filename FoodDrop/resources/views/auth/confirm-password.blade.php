@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="h4 mb-3">Confirm Password</h1>
                    <p class="text-muted">Please confirm your password before continuing.</p>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
