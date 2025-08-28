<x-tt::modal.dialog wire:model="displayData">
    <x-slot name="title">
        {{ $itemId ? "Редактировать элемент" : "Добавить элемент" }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $itemId ? 'update' : 'store' }}"
              class="space-y-indent-half" id="simpleCommonBlockDataForm-{{ $block->id }}">
            <div>
                <label for="simpleCommonTitle-{{ $block->id }}" class="inline-block mb-2">
                    Заголовок
                </label>
                <input type="text" id="simpleCommonTitle-{{ $block->id }}"
                       class="form-control {{ $errors->has("title") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="title">
                <x-tt::form.error name="title"/>
            </div>

            <div>
                <label for="simpleCommonImage-{{ $block->id }}" class="inline-block mb-2">Изображение</label>
                <input type="file" id="simpleCommonImage-{{ $block->id }}"
                       class="form-control {{ $errors->has('image') ? 'border-danger' : '' }}"
                       wire:loading.attr="disabled"
                       wire:model.lazy="image">
                <x-tt::form.error name="image" />
                @include("tt::admin.delete-image-button")
            </div>

            <div>
                <label for="simpleCommonDescription-{{ $block->id }}" class="flex justify-start items-center mb-2">
                    Описание
                    @include("tt::admin.description-button", ["id" => "simpleCommonHidden-{$block->id}"])
                </label>
                @include("tt::admin.description-info", ["id" => "simpleCommonHidden-{$block->id}"])
                <textarea id="simpleCommonDescription-{{ $block->id }}" class="form-control !min-h-52 {{ $errors->has('description') ? 'border-danger' : '' }}"
                          rows="10"
                          wire:model.live="description">
                        {{ $description }}
                    </textarea>
                <x-tt::form.error name="description" />

                <div class="prose prose-sm mt-indent-half">
                    {!! \Illuminate\Support\Str::markdown($description) !!}
                </div>
            </div>

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                    Отмена
                </button>
                <button type="submit" form="simpleCommonBlockDataForm-{{ $block->id }}" class="btn btn-primary" wire:loading.attr="disabled">
                    {{ $itemId ? "Обновить" : "Добавить" }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.dialog>
