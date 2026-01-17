<section>
    <h2 class="h5">Delete Account</h2>
    <p class="text-muted">Once your account is deleted, all of its data will be permanently removed.</p>

    @if($errors->userDeletion->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->userDeletion->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.destroy') }}" class="border rounded p-3">
        @csrf
        @method('DELETE')
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
    </form>
</section>
