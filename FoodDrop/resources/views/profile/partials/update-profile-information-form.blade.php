<section>
    <h2 class="h5">Profile Information</h2>
    <p class="text-muted">Update your account's profile information and email address.</p>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="alert alert-warning">
                Your email address is unverified.
                <button form="send-verification" class="btn btn-link p-0 align-baseline">Resend verification email.</button>
            </div>
            @if (session('status') === 'verification-link-sent')
                <div class="alert alert-success">A new verification link has been sent.</div>
            @endif
        @endif

        <button class="btn btn-primary" type="submit">Save Changes</button>
        @if (session('status') === 'profile-updated')
            <span class="text-success ms-2">Saved.</span>
        @endif
    </form>
</section>
