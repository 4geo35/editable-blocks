<div class="mx-auto w-11/12 mt-indent-half space-y-indent-half">
    @foreach($block->items as $item)
        <div class="card">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <h4 class="font-semibold text-xl">{{ $item->title }}</h4>
                    <div class="flex items-center justify-end ml-indent-half">
                        <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none">
                            <x-tt::ico.edit />
                        </button>
                        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none">
                            <x-tt::ico.trash />
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                Hello
            </div>
        </div>
    @endforeach
</div>
