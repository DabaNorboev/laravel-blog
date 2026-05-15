<div class="mb-12">
    <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <x-inputs.input-label class="ps-1 pb-2">Оставить комментарий</x-inputs.input-label>
            <x-inputs.textarea id="comment" name="comment" rows="4" class="w-full"
                        placeholder="Напишите ваш комментарий здесь..." required
            />
        </div>
        <div class="flex justify-end">
            <x-buttons.primary-button>
                Оставить комментарий
            </x-buttons.primary-button>
        </div>
    </form>
</div>
