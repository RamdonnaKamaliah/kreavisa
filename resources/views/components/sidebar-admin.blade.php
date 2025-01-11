<form method="POST" action="{{ route('logout') }}" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-primary">
        Logout
    </button>
</form>