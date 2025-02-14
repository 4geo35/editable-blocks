<div class="card">
    <div class="card-header border-b-0 space-y-indent-half">
        <div class="flex justify-between items-center">
            <h4 class="text-lg font-semibold">Блок "{{ $block->title }}"</h4>
            <div class="ml-indent-half">
                <button type="button" class="btn btn-primary px-btn-x-ico lg:px-btn-x" wire:click="showCreate">
                    <x-tt::ico.circle-plus />
                    <span class="hidden lg:inline-block pl-btn-ico-text">Добавить элемент</span>
                </button>
                <button type="button" class="btn btn-danger px-btn-x-ico"
                        wire:click="showDeleteBlock"
                        wire:loading.attr="disabled">
                    <x-tt::ico.trash />
                </button>
            </div>
        </div>
        <x-tt::notifications.error prefix="item-{{ $block->id }}-" />
        <x-tt::notifications.success prefix="item-{{ $block->id }}-" />
    </div>
</div>
