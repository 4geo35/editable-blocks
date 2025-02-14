<div class="card">
    <div class="card-header border-b-0">
        <div class="flex justify-between items-center">
            <h4 class="text-lg font-semibold">Блок "{{ $block->title }}"</h4>
            <div class="ml-indent-half">
                <button type="button" class="btn btn-primary px-btn-x-ico lg:px-btn-x">
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
    </div>
</div>
