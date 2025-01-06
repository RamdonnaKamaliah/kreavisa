<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 text-center">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="user">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <input type="email" class="form-control form-control-user" id="email" name="email" :value="old('email')" required autofocus placeholder="Enter Email Address...">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-user btn-block mb-4">
            {{ __('Email Password Reset Link') }}
        </button>

        <hr>

        <!-- Back to Login -->
        <div class="text-center">
            <a class="small" href="{{ route('login') }}">{{ __('Back to Login') }}</a>
        </div>
    </form>
</x-guest-layout>
