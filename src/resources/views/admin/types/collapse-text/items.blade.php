<div class="mx-auto w-11/12 mt-indent-half space-y-indent-half" x-collapse x-show="expanded">
    @foreach($items as $item)
        <div class="card">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    @include("eb::admin.types.includes.priority-buttons")
                    @include("eb::admin.types.includes.edit-delete-buttons")
                </div>
            </div>
            <div class="card-body">
                <div x-data="{ itemExpanded: true }" class="pt-indent-half px-indent border-t border-b border-secondary">
                    <div class="flex items-center justify-between mb-indent-half">
                        <h4 class="font-semibold text-lg cursor-pointer hover:text-primary-hover">{{ $item->title }}</h4>
                        <button type="button" class="cursor-pointer hover:text-primary-hover" x-on:click="itemExpanded = ! itemExpanded">
                            <x-eb::ico.open x-show="! itemExpanded" style="display: none" class="transition-all" />
                            <x-eb::ico.close x-show="itemExpanded" class="transition-all" />
                        </button>
                    </div>
                    <div class="mb-indent-half" x-collapse x-show="itemExpanded">
                        <div class="prose max-w-none">
                            @if ($item->recordable->image_id)
                                <div class="inline-block w-1/3 float-left mr-indent-half mb-indent-half">
                                    <a href="{{ route('thumb-img', ['template' => 'original', 'filename' => $item->recordable->image->file_name]) }}"
                                       target="_blank" class="block basis-auto shrink-0">
                                        <picture class="not-prose">
                                            <img src="{{ route('thumb-img', ['template' => 'collapse-record', 'filename' => $item->recordable->image->file_name]) }}" alt=""
                                                 class="rounded-base">
                                        </picture>
                                    </a>
                                </div>
                            @endif
                            {!! $item->recordable->markdown !!}
                        </div>
                        <div class="clear-both"></div>
                    </div>
                </div>
                @include("eb::admin.types.includes.help-info")
            </div>
        </div>
    @endforeach
</div>
