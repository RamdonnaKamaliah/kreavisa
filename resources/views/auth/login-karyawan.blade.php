<x-guest-layout>
    <div class="text-center mb-4">
        <h1 class="h3 text-gray-900"><i class="fa-solid fa-user"></i> Login Karyawan/Gudang</h1>
    </div>
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
    </form>
</x-guest-layout>
