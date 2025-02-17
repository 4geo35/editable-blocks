<div class="">
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

    <x-tt::modal.confirm wire:model="displayDelete">
        <x-slot name="title">Удалить блок</x-slot>
        <x-slot name="text">Будет невозможно восстановить блок! Так же будут удалены все элементы блока!</x-slot>
    </x-tt::modal.confirm>

    <x-tt::modal.dialog wire:model="displayData">
        <x-slot name="title">
            {{ $blockId ? "Редактировать блок" : "Добавить блок" }} "{{ $typeTitle }}"
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="{{ $blockId ? 'update' : 'store' }}" class="space-y-indent-half" id="blockCreateForm">
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
                    <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                        Отмена
                    </button>
                    <button type="submit" form="blockCreateForm" class="btn btn-primary" wire:loading.attr="disabled">
                        {{ $blockId ? "Обновить" : "Добавить" }}
                    </button>
                </div>
            </form>
        </x-slot>
    </x-tt::modal.dialog>
</div>
