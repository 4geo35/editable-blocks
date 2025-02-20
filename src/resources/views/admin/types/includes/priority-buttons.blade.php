<div class="flex justify-start">
    @can("order", $block::class)
        <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-e-none"
                @if ($loop->last) disabled @endif
                wire:click="moveDown({{ $item->id }})">
            <x-tt::ico.line-arrow-bottom width="18" height="18" />
        </button>
        <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-s-none"
                @if ($loop->first) disabled @endif
                wire:click="moveUp({{ $item->id }})">
            <x-tt::ico.line-arrow-top width="18" height="18" />
        </button>
    @endcan
</div>
