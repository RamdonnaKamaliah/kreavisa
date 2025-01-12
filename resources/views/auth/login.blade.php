<x-guest-layout>
    <div class="text-center mb-4">
        <h1 class="h3 text-gray-900"><i class="fa-solid fa-user"></i> Login Admin</h1>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="user">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <input type="email"
                class=" text-sm w-full px-4 py-2 border border-gray-700 rounded-full  focus:outline-none focus:ring-2 focus:ring-[#FD7170] focus:border-transparent placeholder-gray-400 "
                id="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                placeholder="Enter Email Address...">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <input type="password"
                class="text-sm  w-full px-4 py-2 border border-gray-700 rounded-full focus:outline-none focus:ring-2 focus:ring-[#FD7170] focus:border-transparent placeholder-gray-400"
                id="password" name="password" required autocomplete="current-password" placeholder="Enter Password...">
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
        <button type="submit"
            class="mb-4 bg-[#FD7170] text-white font-semibold py-2 px-56 rounded-full shadow-md hover:shadow-lg hover:bg-opacity-90 transition duration-300 ease-in-out transform hover:scale-105">
            {{ __('Log in') }}
        </button>

        <hr>



        <!-- Forgot Password -->
        <div class="text-center mt-3">
            @if (Route::has('password.request'))
                <a class="small" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
            @endif
        </div>
    </form>
</x-guest-layout>
