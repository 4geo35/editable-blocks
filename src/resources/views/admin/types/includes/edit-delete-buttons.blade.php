<div class="flex items-center justify-end ml-indent-half">
    <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
            wire:click="showEdit({{ $item->id }})"
            wire:loading.attr="disabled">
        <x-tt::ico.edit />
    </button>
    <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
            wire:click="showDelete({{ $item->id }})"
            wire:loading.attr="disabled">
        <x-tt::ico.trash />
    </button>
</div>
