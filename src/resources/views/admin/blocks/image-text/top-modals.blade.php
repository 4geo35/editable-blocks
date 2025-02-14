<x-tt::modal.confirm wire:model="displayDeleteBlock" closeAction="closeDeleteBlock" confirmAction="confirmDeleteBlock">
    <x-slot name="title">Удалить блок</x-slot>
    <x-slot name="text">Будет невозможно восстановить блок! Так же будут удалены все элементы блока!</x-slot>
</x-tt::modal.confirm>
