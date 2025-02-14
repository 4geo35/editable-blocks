<div class="flex flex-col gap-indent-half">
    @if (! empty($blocks) ?? $blocks->count())
        @foreach($blocks as $block)
            <livewire:dynamic-component :component="$block->type_component" :block="$block" :key="$block->id" />
        @endforeach
    @endif
</div>
