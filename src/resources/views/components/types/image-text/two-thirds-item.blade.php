@props(["item", "index"])
@php($hasImage = $item->recordable->image_id)
<div class="">
    @if ($hasImage)
        <div class="mb-indent-half">
            @php($fileName = $item->recordable->image->file_name)
            <a href="{{ route('thumb-img', ['template' => 'original', 'filename' => $fileName]) }}"
               data-fslightbox="lightbox-{{ $item->id }}">
                <picture class="not-prose">
                    <source media="(min-width: 1024px)" srcset="{{ route('thumb-img', ['template' => 'image-text-record-two-thirds', 'filename' => $fileName]) }}">
                    <source media="(min-width: 480px)" srcset="{{ route('thumb-img', ['template' => 'image-text-record-tablet', 'filename' => $fileName]) }}">
                    <img src="{{ route('thumb-img', ['template' => 'image-text-record-mobile', 'filename' => $fileName]) }}" alt="" class="rounded-base">
                </picture>
            </a>
        </div>
    @endif

    <div class="">
        @if ($item->title)
            <h4 class="text-3xl xs:text-4xl font-bold mb-indent-half">{{ $item->title }}</h4>
        @endif
        <div class="prose max-w-none prose-p:leading-6">
            {!! $item->recordable->markdown !!}
        </div>
    </div>
</div>
