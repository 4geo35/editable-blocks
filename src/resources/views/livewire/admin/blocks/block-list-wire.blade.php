<div class="flex flex-col gap-2">
    @if (! empty($blocks) ?? $blocks->count())
        @foreach($blocks as $block)
            <div class="w-11/12 mx-auto">
                <livewire:dynamic-component :component="$block->type_component" :block="$block" :key="$block->id" />
            </div>
        @endforeach
    @endif
</div>
