@props(["block"])
@if ($block->items->count())
    @php($firstItem = $block->items->first())
    <div class="w-full lg:w-10/12 2xl:w-9/12 mx-auto border-t border-stroke" x-data="{ currentItem: {{ $firstItem->id }} }">
        @foreach($block->items as $item)
            <x-eb::types.collapse-text.item :item="$item" :first="$loop->first" />
        @endforeach
    </div>
@endif
