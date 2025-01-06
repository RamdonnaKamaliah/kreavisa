<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="user">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <input type="email" class="form-control form-control-user" id="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter Email Address...">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <input type="password" class="form-control form-control-user" id="password" name="password" required autocomplete="current-password" placeholder="Enter Password...">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                <label class="custom-control-label" for="remember_me">{{ __('Remember Me') }}</label>
            </div>
        </div>

        <!-- Login Button -->
        <button type="submit" class="btn btn-primary btn-user btn-block mb-4">
            {{ __('Log in') }}
        </button>

        <hr>

        <!-- Additional Login Options -->
        <div class="d-flex justify-content-center mt-4">
            <a href="mailto:rifdah.a122@gmail.com" class="btn btn-outline-primary btn-circle mx-2">
                <i class="fas fa-envelope"></i>
            </a>
            
        </div>

        <!-- Forgot Password -->
        <div class="text-center mt-3">
            @if (Route::has('password.request'))
                <a class="small" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
            @endif
        </div>
    </form>
</x-guest-layout>
