<div class="mx-auto w-11/12 mt-indent-half space-y-indent-half">
    @foreach($items as $item)
        <div class="card">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <div class="flex justify-start">
                        <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-e-none"
                                @if ($loop->last) disabled @endif
                                wire:click="moveDown({{ $item->id }})">
                            <x-tt::ico.line-arrow-bottom width="18" height="18" />
                        </button>
                        <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-s-none"
                                @if ($loop->first) disabled @endif
                                wire:click="moveUp({{ $item->id }})">
                            <x-tt::ico.line-arrow-top width="18" height="18" />
                        </button>
                    </div>
                    <div class="flex items-center justify-end ml-indent-half">
                        <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                                wire:click="showEdit({{ $item->id }})"
                                wire:loading.attr="disabled">
                            <x-tt::ico.edit />
                        </button>
                        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                                wire:click="showDelete({{ $item->id }})"
                                wire:loading.attr="disabled">
                            <x-tt::ico.trash />
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col w-full md:w-1/2">
                        <div class="h-full flex flex-col justify-center">
                            <h2 class="font-semibold text-2xl mb-indent-half">{{ $item->title }}</h2>
                            <div class="prose max-w-none">{!! $item->recordable->description !!}</div>
                        </div>
                    </div>
                    <div class="col w-full md:w-1/2">
                        <a href="{{ route('thumb-img', ['template' => 'original', 'filename' => $item->recordable->image->file_name]) }}"
                           target="_blank" class="block mr-indent mb-indent basis-auto shrink-0">
                            <picture>
                                <img src="{{ route('thumb-img', ['template' => 'image-text-record', 'filename' => $item->recordable->image->file_name]) }}" alt="" class="mb-indent-half rounded-base">
                            </picture>
                        </a>
                    </div>
                </div>

                <div class="text-info font-medium mt-indent-half text-xs">
                    Так как размер сайта и панели администрирования отличаются, здесь показано, как изображение соотносится с текстом и какой оно имеет размер. Также может отличаться стиль и шрифт текста.
                </div>
            </div>
        </div>
    @endforeach
</div>
