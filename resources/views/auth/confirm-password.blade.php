<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            ::type="show ? 'text' : 'password'"
                            name="password"
                            required autocomplete="current-password" />
            
            <div class="mt-2">
                <label for="show_password_confirm_auth" class="inline-flex items-center text-sm text-gray-600 cursor-pointer">
                    <input id="show_password_confirm_auth" type="checkbox" @click="show = !show" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ms-2">{{ __('Show Password') }}</span>
                </label>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
