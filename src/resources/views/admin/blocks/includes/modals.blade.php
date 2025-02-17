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

<x-tt::modal.dialog wire:model="displayOrder">
    <x-slot name="title">
        Порядок блоков
    </x-slot>
    <x-slot name="content">
        <x-tt::notifications.error prefix="block-list-" />
        <x-tt::notifications.success prefix="block-list-" />
        <x-tt::table drag-root>
            <x-slot name="body">
                @if ($blockOrderList)
                    @foreach($blockOrderList as $key => $item)
                        <tr drag-item="{{ $item->id }}" drag-item-order="{{ $key }}" wire:key="{{ $item->id }}">
                            <td class="align-middle border-none !px-0 !py-indent-half">
                                <div class="flex items-center h-full">
                                    <x-tt::ico.bars drag-grab class="text-secondary mr-indent cursor-grab" />
                                    <div>
                                        {{ $item->title }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </x-slot>
        </x-tt::table>
    </x-slot>
</x-tt::modal.dialog>
