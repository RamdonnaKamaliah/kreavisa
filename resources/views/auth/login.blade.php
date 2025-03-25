<x-guest-layout>
    <div class="flex min-h-screen items-center justify-center p-6">
        <div class="bg-white rounded-2xl shadow-lg flex flex-col md:flex-row overflow-hidden w-full max-w-4xl md:ml-20">
            <!-- Form Login -->
            <div class="md:w-1/2 p-8 flex flex-col justify-center">
                <h1 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fa-solid fa-user mr-2"></i> Login Admin
                </h1>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <input type="email" name="email" id="email" required autofocus
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600"
                            placeholder="Enter Email Address...">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600"
                            placeholder="Enter Password...">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" id="remember_me" name="remember" class="mr-2">
                        <label for="remember_me" class="text-gray-600">Remember Me</label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full bg-gray-900 text-white font-semibold py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                        Log in
                    </button>
                </form>

                <!-- Forgot Password -->
                {{-- <div class="text-center mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-blue-500 hover:underline" href="{{ route('password.request') }}">Forgot your
                            password?</a>
                    @endif
                </div> --}}
            </div>

            <!-- Ilustrasi -->
            <div
                class="hidden md:flex md:w-1/2 bg-gradient-to-r from-white via-gray-300 to-[#1D232A] items-center justify-center p-8">
                <img src="{{ asset('assets/img/foto-login-admin.png') }}" alt="Illustration" class="w-3/4">
            </div>
        </div>
    </div>
</x-guest-layout>
