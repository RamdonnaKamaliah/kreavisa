<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-8 px-4">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-semibold text-center mb-6">Reset Password</h2>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email"
                        value="{{ old('email', $request->email) }}" required autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                    <x-input-error :messages="$errors->get('email')" class="text-sm text-red-500 mt-1" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                        <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" onclick="toggleVisibility('password', this)">
                            👁️
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="text-sm text-red-500 mt-1" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                        <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" onclick="toggleVisibility('password_confirmation', this)">
                            👁️
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-sm text-red-500 mt-1" />
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Reset Password</button>
            </form>
        </div>
    </div>

    <script>
        function toggleVisibility(id, el) {
            const input = document.getElementById(id);
            if (input.type === 'password') {
                input.type = 'text';
                el.textContent = '🙈';
            } else {
                input.type = 'password';
                el.textContent = '👁️';
            }
        }
    </script>
</x-guest-layout>
