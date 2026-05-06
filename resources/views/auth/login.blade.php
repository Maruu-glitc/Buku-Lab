<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                    Buku Tamu
                </h1>
                <p class="text-gray-600">Selamat datang kembali</p>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Top Accent -->
                <div class="h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

                <div class="p-8">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-6" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="block text-sm font-semibold text-gray-700 mb-2" />
                            <x-text-input 
                                id="email" 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 placeholder-gray-400" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                placeholder="nama@email.com"
                                required 
                                autofocus 
                                autocomplete="username" 
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="block text-sm font-semibold text-gray-700 mb-2" />

                            <x-text-input 
                                id="password" 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 placeholder-gray-400"
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                required 
                                autocomplete="current-password" 
                            />

                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                                <input 
                                    id="remember_me" 
                                    type="checkbox" 
                                    class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500" 
                                    name="remember"
                                >
                                <span class="ms-3 text-sm text-gray-600 font-medium">{{ __('Ingat saya') }}</span>
                            </label>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col gap-4 pt-2">
                            <x-primary-button class="w-full flex items-center justify-center py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white  font-semibold rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                                {{ __('Masuk') }}
                            </x-primary-button>

                            @if (Route::has('password.request'))
                                <a 
                                    class="text-center text-sm text-blue-600 hover:text-blue-700 font-medium transition duration-200" 
                                    href="{{ route('password.request') }}"
                                >
                                    {{ __('Lupa password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Info -->
            <p class="text-center text-gray-600 text-sm mt-8">
                Sistem Buku Tamu Laboratorium
            </p>
        </div>
    </div>
</x-guest-layout>
