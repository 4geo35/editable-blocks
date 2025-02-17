<div class="card">
    <div class="card-header border-b-0 space-y-indent-half">
        <div class="flex justify-between sm:items-center">
            <h4 class="text-lg font-semibold">Блок "{{ $block->title }}"</h4>
            <div class="ml-indent-half flex flex-col sm:flex-row space-x-2">
                <button type="button" class="btn btn-primary px-btn-x-ico lg:px-btn-x" wire:click="showCreate">
                    <x-tt::ico.circle-plus />
                    <span class="hidden lg:inline-block pl-btn-ico-text">Добавить элемент</span>
                </button>
                <div class="flex items-center">
                    <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                            wire:click="fireEdit">
                        <x-tt::ico.edit />
                    </button>
                    <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                            wire:click="fireDelete"
                            wire:loading.attr="disabled">
                        <x-tt::ico.trash />
                    </button>
                </div>
            </div>
        </div>
        <x-tt::notifications.error prefix="item-{{ $block->id }}-" />
        <x-tt::notifications.success prefix="item-{{ $block->id }}-" />
    </div>
</div>
