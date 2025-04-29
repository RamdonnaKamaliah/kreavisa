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
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600 pr-10"
                            placeholder="Enter Password...">
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500"
                            onclick="togglePassword()">
                            <!-- ikon mata terbuka (hidden awal) -->
                            <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- ikon mata dicoret (tampil awal) -->
                            <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.223-3.607m1.77-1.77A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a10.05 10.05 0 01-1.233 2.945M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                            </svg>
                        </button>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <script>
                        function togglePassword() {
                            const pwd = document.getElementById('password');
                            const eye = document.getElementById('icon-eye');
                            const eyeOff = document.getElementById('icon-eye-off');
                            if (pwd.type === 'password') {
                                pwd.type = 'text';
                                eye.classList.remove('hidden');
                                eyeOff.classList.add('hidden');
                            } else {
                                pwd.type = 'password';
                                eye.classList.add('hidden');
                                eyeOff.classList.remove('hidden');
                            }
                        }
                    </script>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" id="remember_me" name="remember" class="mr-2">
                        <label for="remember_me" class="text-gray-600">Ingat Saya</label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full bg-gray-900 text-white font-semibold py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                        Log in
                    </button>
                </form>

                 <!-- Forgot Password -->
                 <div class="text-center mt-4">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">Lupa Password?</a>
                    @endif
                </div>
            </div>

            <!-- Ilustrasi -->
            <div
                class="hidden md:flex md:w-1/2 bg-gradient-to-r from-white via-gray-300 to-[#1D232A] items-center justify-center p-8">
                <img src="{{ asset('assets/img/foto-login-admin.png') }}" alt="Illustration" class="w-3/4">
            </div>
        </div>
    </div>
</x-guest-layout>
