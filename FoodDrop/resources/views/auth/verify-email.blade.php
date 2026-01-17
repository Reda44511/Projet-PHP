@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="h4 mb-3">Verify Email</h1>
                    <p class="text-muted">Thanks for signing up! Please verify your email address by clicking the link in the email we sent you. If you didn't receive it, we can send another.</p>
                    @if(session('status') === 'verification-link-sent')
                        <div class="alert alert-success">A new verification link has been sent to your email.</div>
                    @endif
                    <div class="d-flex justify-content-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button class="btn btn-primary" type="submit">Resend Email</button>
                        </form>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-secondary" type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
