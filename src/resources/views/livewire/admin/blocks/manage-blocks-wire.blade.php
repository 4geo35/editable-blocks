<div class="">
    <div class="card">
        <div class="card-header">
            <h2 class="font-medium text-2xl">Добавить блок</h2>
        </div>
        <div class="card-body">
            <div class="space-y-indent-half">
                <div class="flex flex-col sm:flex-row flex-nowrap sm:flex-wrap">
                    @if (empty($blockList))
                        <span class="text-danger font-medium">Нет доступных для добавления блоков</span>
                    @endif
                    @foreach($blockList as $type => $title)
                        <button type="button"
                                class="btn btn-primary my-1 sm:mr-indent-half"
                                wire:click="showCreate('{{ $type }}')">
                            {{ $title }}
                        </button>
                    @endforeach
                </div>
                <x-tt::notifications.error prefix="manage-" />
                <x-tt::notifications.success prefix="manage-" />
            </div>
        </div>
    </div>

    @include("eb::admin.blocks.includes.modals")
</div>
