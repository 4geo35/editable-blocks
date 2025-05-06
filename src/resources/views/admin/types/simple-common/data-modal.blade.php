<x-tt::modal.dialog wire:model="displayData">
    <x-slot name="title">
        {{ $itemId ? "Редактировать элемент" : "Добавить элемент" }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $itemId ? 'update' : 'store' }}"
              class="space-y-indent-half" id="imageTextBlockDataForm-{{ $block->id }}">
            <div>
                <label for="imageTextTitle-{{ $block->id }}" class="inline-block mb-2">
                    Заголовок <span class="text-danger">*</span>
                </label>
                <input type="text" id="imageTextTitle-{{ $block->id }}"
                       class="form-control {{ $errors->has("title") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="title">
                <x-tt::form.error name="title"/>
            </div>

            <div>
                <label for="imageTextImage-{{ $block->id }}" class="inline-block mb-2">Изображение</label>
                <input type="file" id="imageTextImage-{{ $block->id }}"
                       class="form-control {{ $errors->has('image') ? 'border-danger' : '' }}"
                       wire:loading.attr="disabled"
                       wire:model.lazy="image">
                <x-tt::form.error name="image" />
                @include("tt::admin.delete-image-button")
            </div>

            <div>
                <label for="imageTextDescription-{{ $block->id }}" class="flex justify-start items-center mb-2">
                    Описание <span class="text-danger">*</span>
                    @include("tt::admin.description-button", ["id" => "imageTextHidden-{$block->id}"])
                </label>
                @include("tt::admin.description-info", ["id" => "imageTextHidden-{$block->id}"])
                <textarea id="imageTextDescription-{{ $block->id }}" class="form-control !min-h-52 {{ $errors->has('description') ? 'border-danger' : '' }}"
                          rows="10" required
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
                <button type="submit" form="imageTextBlockDataForm-{{ $block->id }}" class="btn btn-primary" wire:loading.attr="disabled">
                    {{ $itemId ? "Обновить" : "Добавить" }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.dialog>
