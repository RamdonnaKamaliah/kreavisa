<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold text-gray-700 text-center mb-4">Forgot Your Password?</h2>
            <p class="text-sm text-gray-600 text-center mb-6">
                {{ __('No problem. Just enter your email address and we will send you a password reset link.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-center text-green-600" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" :value="old('email')" required autofocus
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter your email...">
                    <x-input-error :messages="$errors->get('email')" class="text-red-500 text-sm mt-1" />
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg shadow-md transition duration-300">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}"
                    class="text-blue-600 hover:underline text-sm">{{ __('Back to Login') }}</a>
            </div>
        </div>
    </div>
</x-guest-layout>
