<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ "Обновление пароля" }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ "Для обеспечения безопасности убедитесь, что в вашей учетной записи используется длинный, случайный пароль." }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-inputs.input-label for="update_password_current_password" value="{{ 'Текущий пароль' }}" />
            <x-inputs.text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-inputs.input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-inputs.input-label for="update_password_password" value="{{ 'Новый пароль' }}" />
            <x-inputs.text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-inputs.input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-inputs.input-label for="update_password_password_confirmation" value="{{ 'Подтверждение пароля' }}" />
            <x-inputs.text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-inputs.input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-buttons.primary-button>{{ "Сохранить" }}</x-buttons.primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ 'Пароль изменён' }}</p>
            @endif
        </div>
    </form>
</section>
