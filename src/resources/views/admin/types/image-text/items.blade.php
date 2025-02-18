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
                <div class="row">
                    <div class="col w-full md:w-1/2">
                        <div class="h-full flex flex-col justify-center">
                            <h2 class="font-semibold text-2xl mb-indent-half">{{ $item->title }}</h2>
                            <div class="prose max-w-none">{!! $item->recordable->markdown !!}</div>
                        </div>
                    </div>
                    <div class="col w-full md:w-1/2">
                        <a href="{{ route('thumb-img', ['template' => 'original', 'filename' => $item->recordable->image->file_name]) }}"
                           target="_blank" class="block mr-indent mb-indent basis-auto shrink-0">
                            <picture>
                                <img src="{{ route('thumb-img', ['template' => 'image-text-record', 'filename' => $item->recordable->image->file_name]) }}" alt=""
                                     class="mb-indent-half rounded-base">
                            </picture>
                        </a>
                    </div>
                </div>

                @include("eb::admin.types.includes.help-info")
            </div>
        </div>
    @endforeach
</div>
