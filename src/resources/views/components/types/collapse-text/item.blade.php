@props(["item", "first"])
<div class="p-indent border-b border-stroke">
    <div class="flex items-center justify-between">
        <h4 class="text-xl font-semibold cursor-pointer hover:text-primary-hover transition-all"
              x-on:click="currentItem = currentItem === {{ $item->id }} ? 0 : {{ $item->id}}">
            {{ $item->title }}
        </h4>
        <button type="button" class="cursor-pointer transition-all rounded-full bg-black/5 hover:bg-black/15 ml-indent-half"
                x-on:click="currentItem = currentItem === {{ $item->id }} ? 0 : {{ $item->id }}">
            <x-eb::ico.open x-show="currentItem !== {{ $item->id }}" style="display: none" class="transition-all" />
            <x-eb::ico.close x-show="currentItem === {{ $item->id }}" class="transition-all" />
        </button>
    </div>
    <div x-collapse x-show="currentItem === {{ $item->id }}" @if (!$first) style="display: none" @endif>
        <div class="prose max-w-none prose-p:leading-6">
            @if ($item->recordable->image_id)
                @php($fileName = $item->recordable->image->file_name)
                <div class="inline-block w-full lg:w-1/2 xl:w-5/12 float-left lg:mr-indent-half mb-indent-half">
                    <a href="{{ route('thumb-img', ['template' => 'original', 'filename' => $fileName]) }}"
                       data-fslightbox="lightbox-{{ $item->id }}">
                        <picture class="not-prose">
                            <source media="(min-width: 1024px)" srcset="{{ route('thumb-img', ['template' => 'collapse-record', 'filename' => $fileName]) }}">
                            <source media="(min-width: 480px)" srcset="{{ route('thumb-img', ['template' => 'collapse-record-tablet', 'filename' => $fileName]) }}">
                            <img src="{{ route('thumb-img', ['template' => 'collapse-record-mobile', 'filename' => $fileName]) }}" alt="" class="rounded-base">
                        </picture>
                    </a>
                </div>
            @else <span></span>
            @endif
            {!! $item->recordable->markdown !!}
            <div class="clear-both"></div>
        </div>
    </div>
</div>
