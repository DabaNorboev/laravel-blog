<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ "Удалить учётную запись" }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ 'После удаления вашей учетной записи все ее ресурсы и данные будут безвозвратно удалены. Перед удалением учетной записи, пожалуйста, загрузите все данные или информацию, которые вы хотите сохранить.' }}
        </p>
    </header>

    <x-buttons.danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ 'Удалить учётную запись' }}</x-buttons.danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('users.destroy', ['user' => Auth::user()]) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ 'Вы уверены, что хотите удалить свою учетную запись?' }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ 'После удаления вашей учетной записи все ее ресурсы и данные будут безвозвратно удалены. Пожалуйста, введите свой пароль, чтобы подтвердить, что вы хотите навсегда удалить свою учетную запись.' }}
            </p>

            <div class="mt-6">
                <x-inputs.input-label for="password" value="{{ 'Пароль' }}" class="sr-only" />

                <x-inputs.text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ 'Пароль' }}"
                />

                <x-inputs.input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-buttons.secondary-button x-on:click="$dispatch('close')">
                    {{ 'Отменить' }}
                </x-buttons.secondary-button>

                <x-buttons.danger-button class="ms-3">
                    {{ 'Удалить учётную запись' }}
                </x-buttons.danger-button>
            </div>
        </form>
    </x-modal>
</section>
