@props(["block"])
@if ($block->items->count())
    <div class="flex flex-col gap-indent-half">
        @foreach($block->items as $index => $item)
            <x-eb::types.image-text.item :item="$item" :index="$index" />
        @endforeach
    </div>
@endif
