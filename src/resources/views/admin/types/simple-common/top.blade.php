<div class="card">
    <div class="card-header border-b-0 space-y-indent-half">
        <div class="flex justify-between sm:items-center">
            <button type="button" class="cursor-pointer hover:text-primary-hover flex items-center" x-on:click="expanded = !expanded">
                <span class="text-lg font-semibold mr-indent-half inline-block">Блок "{{ $block->title }}"</span>
                @if ($block->render_title)
                    <span class="text-sm text-secondary font-semibold mr-indent-half inline-block">({{ $block->render_title }})</span>
                @endif
                <span class="inline-block transition-all" :class="expanded ? 'rotate-180' : ''"><x-tt::ico.arrow-down /></span>
            </button>
            <div class="ml-indent-half flex flex-col sm:flex-row space-x-2">
                @can("create", $block::class)
                    <button type="button" class="btn btn-primary px-btn-x-ico lg:px-btn-x"
                            wire:loading.attr="disabled"
                            wire:click="showCreate">
                        <x-tt::ico.circle-plus />
                        <span class="hidden lg:inline-block pl-btn-ico-text">Добавить элемент</span>
                    </button>
                @endcan
                @if (! $block->key)
                    <div class="flex items-center">
                        <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                                @cannot("update", $block) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="fireEdit">
                            <x-tt::ico.edit />
                        </button>
                        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                                @cannot("delete", $block) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="fireDelete">
                            <x-tt::ico.trash />
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <x-tt::notifications.error prefix="item-{{ $block->id }}-" />
        <x-tt::notifications.success prefix="item-{{ $block->id }}-" />
    </div>
</div>
