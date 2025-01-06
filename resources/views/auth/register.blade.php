<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="user">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="name" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter Full Name...">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <input type="email" class="form-control form-control-user" id="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter Email Address...">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <input type="password" class="form-control form-control-user" id="password" name="password" required autocomplete="new-password" placeholder="Enter Password...">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password...">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Register Button -->
        <button type="submit" class="btn btn-primary btn-user btn-block mb-4">
            {{ __('Register') }}
        </button>

        <hr>

        <!-- Already Registered -->
        <div class="text-center">
            <a class="small" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
        </div>
    </form>
</x-guest-layout>