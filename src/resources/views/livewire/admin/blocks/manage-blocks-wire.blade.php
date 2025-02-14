<div class="mt-indent-half">
    <div class="card">
        <div class="card-header">
            <h2 class="font-medium text-2xl">Добавить блок</h2>
        </div>
        <div class="card-body">
            <div class="space-y-indent-half">
                <div class="flex flex-col sm:flex-row flex-nowrap sm:flex-wrap">
                    @if (empty($blockList))
                        <span class="text-danger font-medium">Нет доступных для добавления блоков</span>
                    @endif
                    @foreach($blockList as $type => $title)
                        <button type="button"
                                class="btn btn-primary my-1 sm:mr-indent-half"
                                wire:click="showCreate('{{ $type }}')">
                            {{ $title }}
                        </button>
                    @endforeach
                </div>
                <x-tt::notifications.error prefix="manage-" />
                <x-tt::notifications.success prefix="manage-" />
            </div>
        </div>
    </div>

    <x-tt::modal.dialog wire:model="displayCreate">
        <x-slot name="title">Добавить блок "{{ $typeTitle }}"</x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="store" class="space-y-indent-half" id="blockCreateForm">
                <div>
                    <label for="blockTitle" class="inline-block mb-2">
                        Заголовок
                    </label>
                    <input type="text" id="blockTitle"
                           class="form-control {{ $errors->has("title") ? "border-danger" : "" }}"
                           wire:loading.attr="disabled"
                           wire:model="title">
                    <x-tt::form.error name="title"/>
                    <span class="text-info text-sm">Не влияет на вывод на сайт, нужен только для удобства в панели администрирования.</span>
                </div>

                <div class="flex items-center space-x-indent-half">
                    <button type="button" class="btn btn-outline-dark" wire:click="closeCreate">
                        Отмена
                    </button>
                    <button type="submit" form="blockCreateForm" class="btn btn-primary" wire:loading.attr="disabled">
                        Сохранить
                    </button>
                </div>
            </form>
        </x-slot>
    </x-tt::modal.dialog>
</div>
