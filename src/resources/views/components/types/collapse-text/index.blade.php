@props(["block", "isFullPage" => true])
@if ($block->items->count())
    @if ($block->render_title)
        <x-tt::h2 class="w-full {{ $isFullPage ? 'lg:w-10/12 2xl:w-9/12 mx-auto' : '' }} mb-indent-half">{{ $block->render_title }}</x-tt::h2>
    @endif
    @php($firstItem = $block->items->first())
    <div {{ $attributes->merge(["class" => ($isFullPage ? "lg:w-10/12 2xl:w-9/12 mx-auto" : "") . "w-full border-t border-stroke"]) }}
         x-data="{ currentItem: {{ $firstItem->id }} }">
        @foreach($block->items as $item)
            @if ($isFullPage) <x-eb::types.collapse-text.item :item="$item" :first="$loop->first" />
            @else <x-eb::types.collapse-text.two-thirds-item :item="$item" :first="$loop->first" />
            @endif
        @endforeach
    </div>
@endif
