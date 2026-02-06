<div class="">
    @if ($currentGroup != "static")
        <div class="card">
            <x-tt::wire-loading />
            <div class="card-header">
                <div class="flex justify-between">
                    <h2 class="font-medium text-2xl">Добавить блок</h2>
                    <button type="button" class="btn btn-primary px-btn-x-ico lg:px-btn-x"
                            @cannot("order", config("editable-blocks.customBlockModel") ?? \GIS\EditableBlocks\Models\Block::class) disabled
                            @else wire:loading.attr="disabled"
                            @endcannot
                            wire:click="showOrder">
                        <x-tt::ico.bars />
                        <span class="hidden lg:inline-block pl-btn-ico-text">Порядок</span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="space-y-indent-half">
                    <div class="flex flex-col sm:flex-row flex-nowrap sm:flex-wrap">
                        @if (empty($blockList))
                            <span class="text-danger font-medium">Нет доступных для добавления блоков</span>
                        @endif
                        @foreach($blockList as $type => $info)
                            <button type="button"
                                    class="btn btn-primary my-1 sm:mr-indent-half"
                                    @cannot("create", config("editable-blocks.customBlockModel") ?? \GIS\EditableBlocks\Models\Block::class) disabled
                                    @else wire:loading.attr="disabled"
                                    @endcannot
                                    wire:click="showCreate('{{ $type }}')">
                                {{ $info["title"] }}
                            </button>
                        @endforeach
                    </div>
                    <x-tt::notifications.error prefix="manage-" />
                    <x-tt::notifications.success prefix="manage-" />
                </div>
            </div>
        </div>

        @include("eb::admin.blocks.includes.modals")
    @endif
</div>
@include("tt::admin.draggable-script")
