<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div x-data="{ show: false }">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" ::type="show ? 'text' : 'password'" class="mt-1 block w-full" autocomplete="current-password" />
            <div class="mt-2">
                <label for="show_password_current" class="inline-flex items-center text-sm text-gray-600 cursor-pointer">
                    <input id="show_password_current" type="checkbox" @click="show = !show" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ms-2">{{ __('Show Password') }}</span>
                </label>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" ::type="show ? 'text' : 'password'" class="mt-1 block w-full" autocomplete="new-password" />
            <div class="mt-2">
                <label for="show_password_new" class="inline-flex items-center text-sm text-gray-600 cursor-pointer">
                    <input id="show_password_new" type="checkbox" @click="show = !show" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ms-2">{{ __('Show Password') }}</span>
                </label>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" ::type="show ? 'text' : 'password'" class="mt-1 block w-full" autocomplete="new-password" />
            <div class="mt-2">
                <label for="show_password_confirm_up" class="inline-flex items-center text-sm text-gray-600 cursor-pointer">
                    <input id="show_password_confirm_up" type="checkbox" @click="show = !show" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ms-2">{{ __('Show Password') }}</span>
                </label>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
