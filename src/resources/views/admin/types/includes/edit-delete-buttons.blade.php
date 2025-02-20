<div class="flex items-center justify-end ml-indent-half">
    <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
            @cannot("update", $block) disabled
            @else wire:loading.attr="disabled"
            @endcan
            wire:click="showEdit({{ $item->id }})">
        <x-tt::ico.edit />
    </button>
    <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
            @cannot("delete", $block) disabled
            @else wire:loading.attr="disabled"
            @endcan
            wire:click="showDelete({{ $item->id }})">
        <x-tt::ico.trash />
    </button>
</div>
