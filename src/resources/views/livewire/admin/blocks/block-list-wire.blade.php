<div class="flex flex-col gap-indent-half relative">
    @if (! empty($blocks) ?? $blocks->count())
        <x-tt::wire-loading />
        @foreach($blocks as $block)
            <livewire:dynamic-component :component="$block->type_component" :block="$block" :key="$block->id" lazy />
        @endforeach
    @endif
</div>
