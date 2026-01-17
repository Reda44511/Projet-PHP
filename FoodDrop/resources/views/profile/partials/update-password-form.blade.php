<section>
    <h2 class="h5">Update Password</h2>
    <p class="text-muted">Use a strong password to keep your account safe.</p>

    @if($errors->updatePassword->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->updatePassword->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit">Update Password</button>
        @if (session('status') === 'password-updated')
            <span class="text-success ms-2">Updated.</span>
        @endif
    </form>
</section>
