@props(["item", "index"])
@php($hasImage = $item->recordable->image_id)
<div class="{{ $hasImage ? 'row' : 'w-full lg:w-8/12' }}">
    @if ($hasImage)
        <div class="col w-full lg:w-1/2 ml-auto order-last {{ $index % 2 > 0 ? 'lg:order-last' : 'lg:order-first' }}">
            <div class="h-full flex flex-col justify-center mb-indent-half xl:w-[525px] mx-auto">
                @if ($item->title)
                    <h4 class="text-3xl xs:text-4xl lg:text-5xl font-bold mb-indent-half">{{ $item->title }}</h4>
                @endif
                <div class="prose max-w-none prose-p:leading-6">
                    {!! $item->recordable->markdown !!}
                </div>
            </div>
        </div>
        <div class="col w-full lg:w-1/2 relative mb-indent-half lg:mb-0">
            @php($fileName = $item->recordable->image->file_name)
            <a href="{{ route('thumb-img', ['template' => 'original', 'filename' => $fileName]) }}"
               data-fslightbox="lightbox-{{ $item->id }}" class="sticky top-0">
                <picture class="not-prose">
                    <source media="(min-width: 1024px)" srcset="{{ route('thumb-img', ['template' => 'image-text-record', 'filename' => $fileName]) }}">
                    <source media="(min-width: 480px)" srcset="{{ route('thumb-img', ['template' => 'image-text-record-tablet', 'filename' => $fileName]) }}">
                    <img src="{{ route('thumb-img', ['template' => 'image-text-record-mobile', 'filename' => $fileName]) }}" alt="" class="rounded-base">
                </picture>
            </a>
        </div>
    @else
        @if ($item->title)
            <h4 class="text-3xl xs:text-4xl lg:text-5xl font-bold mb-indent-half">{{ $item->title }}</h4>
        @endif
        <div class="prose max-w-none prose-p:leading-6">
            {!! $item->recordable->markdown !!}
        </div>
    @endif
</div>
