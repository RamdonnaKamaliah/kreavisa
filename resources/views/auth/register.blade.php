<x-guest-layout>
    <div class="text-center mb-4">
        <h1 class="h3 text-gray-900"><i class="fa-solid fa-user"></i> Register</h1>
    </div>

    <form method="POST" action="{{ route('register') }}" class="user">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <input type="text" class="text-sm  w-full px-4 py-2 border border-gray-700 rounded-full focus:outline-none focus:ring-2 focus:ring-[#FD7170] focus:border-transparent placeholder-gray-400" id="name" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter Full Name...">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <input type="email" class="text-sm  w-full px-4 py-2 border border-gray-700 rounded-full focus:outline-none focus:ring-2 focus:ring-[#FD7170] focus:border-transparent placeholder-gray-400" id="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter Email Address...">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <input type="password" class="text-sm  w-full px-4 py-2 border border-gray-700 rounded-full focus:outline-none focus:ring-2 focus:ring-[#FD7170] focus:border-transparent placeholder-gray-400" id="password" name="password" required autocomplete="new-password" placeholder="Enter Password...">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <input type="password" class="text-sm  w-full px-4 py-2 border border-gray-700 rounded-full focus:outline-none focus:ring-2 focus:ring-[#FD7170] focus:border-transparent placeholder-gray-400" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password...">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Register Button -->
        <button type="submit" class="mb-4 bg-[#FD7170] text-white font-semibold py-2 px-56 rounded-full shadow-md hover:shadow-lg hover:bg-opacity-90 transition duration-300 ease-in-out transform hover:scale-105">
            {{ __('Register') }}
        </button>

        <hr>

        <!-- Already Registered -->
        <div class="text-center">
            <a class="small" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
        </div>
    </form>
</x-guest-layout>