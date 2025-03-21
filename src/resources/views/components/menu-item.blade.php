@can("viewAny", config("editable-blocks.customBlockModel") ?? \GIS\EditableBlocks\Models\Block::class)
    <x-tt::admin-menu.item
        href="{{ route('admin.blocks.index') }}"
        :active="in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.blocks.index'])">
        <x-slot name="ico"><x-eb::ico.blocks /></x-slot>
        Блоки
    </x-tt::admin-menu.item>
@endcan
