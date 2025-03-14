@if ($imageUrl)
    <div class="mt-indent-half flex items-center">
        <a href="{{ $imageUrl }}" target="_blank" class="text-primary hover:text-primary-hover mr-indent-half inline-block">
            Изображение
        </a>
        @if ($displayDeleteImage)
            <div class="flex items-center space-x-2">
                <button type="button" class="text-danger hover:text-danger/40 cursor-pointer font-semibold"
                        wire:click="clearImage">
                    ОК
                </button>
                <button type="button" class="text-dark hover:text-dark/40 cursor-pointer"
                        wire:click="closeClearImage">
                    <x-tt::ico.cross />
                </button>
            </div>
        @else
            <button type="button" class="text-danger hover:text-danger/40 cursor-pointer"
                    wire:click="showClearImage">
                <x-tt::ico.cross />
            </button>
        @endif
    </div>
@endif
