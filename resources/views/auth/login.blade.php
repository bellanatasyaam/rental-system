<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Tombol Login dengan Google -->
    <div class="mt-6">
        <a href="{{ route('google.login') }}"
           class="w-full flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">
            <svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
              <path d="M21.35 11.1h-9.18v2.92h5.38c-.23 1.24-.92 2.29-1.95 2.99v2.5h3.16c1.86-1.71 2.93-4.23 2.93-7.2 0-.62-.06-1.23-.17-1.81z" />
              <path d="M12.17 22c2.63 0 4.84-.87 6.45-2.35l-3.16-2.5c-.88.59-2.01.93-3.29.93-2.53 0-4.68-1.71-5.45-4h-3.25v2.52C5.13 19.7 8.38 22 12.17 22z" />
              <path d="M6.72 13.58c-.2-.59-.32-1.22-.32-1.88s.12-1.29.32-1.88V7.3H3.47A9.82 9.82 0 0 0 2.35 11.7c0 1.6.38 3.11 1.12 4.4l3.25-2.52z" />
              <path d="M12.17 4.78c1.43 0 2.72.49 3.73 1.45l2.8-2.8C16.99 1.7 14.79.78 12.17.78 8.38.78 5.13 3.08 3.47 6.37l3.25 2.52c.77-2.29 2.92-4.1 5.45-4.1z" />
            </svg>
            {{ __('Login dengan Google') }}
        </a>
    </div>
</x-guest-layout>
