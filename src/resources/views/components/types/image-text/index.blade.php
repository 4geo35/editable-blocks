@props(["block"])
@if ($block->items->count())
    @if ($block->render_title)
        <x-tt::h2 class="mb-indent-half">{{ $block->render_title }}</x-tt::h2>
    @endif
    <div {{ $attributes->merge(["class" => "flex flex-col gap-indent-half"]) }}>
        @foreach($block->items as $index => $item)
            <x-eb::types.image-text.item :item="$item" :index="$index" />
        @endforeach
    </div>
@endif
