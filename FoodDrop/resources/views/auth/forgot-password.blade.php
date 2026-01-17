@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="h4 mb-3">Forgot Password</h1>
                    <p class="text-muted">Enter your email and we'll send you a reset link.</p>
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Send Reset Link</button>
                    </form>
                </div>
            </div>
            <p class="text-center mt-3"><a href="{{ route('login') }}">Back to login</a></p>
        </div>
    </div>
@endsection
