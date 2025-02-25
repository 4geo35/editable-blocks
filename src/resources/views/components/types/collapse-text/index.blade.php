@props(["block"])
@if ($block->items->count())
    @if ($block->render_title)
        <x-tt::h2 class="w-full lg:w-10/12 2xl:w-9/12 mx-auto mb-indent-half">{{ $block->render_title }}</x-tt::h2>
    @endif
    @php($firstItem = $block->items->first())
    <div {{ $attributes->merge(["class" => "w-full lg:w-10/12 2xl:w-9/12 mx-auto border-t border-stroke"]) }}
         x-data="{ currentItem: {{ $firstItem->id }} }">
        @foreach($block->items as $item)
            <x-eb::types.collapse-text.item :item="$item" :first="$loop->first" />
        @endforeach
    </div>
@endif
