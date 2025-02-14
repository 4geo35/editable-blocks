<div class="card">
    <div class="card-body">
        <div class="space-y-indent-half">
            <div class="flex flex-col sm:flex-row flex-nowrap sm:flex-wrap">
                @if (empty($buttons))
                    <span class="text-danger font-medium">Нет доступных групп блоков</span>
                @endif
                @foreach($buttons as $button)
                    <button type="button"
                            class="btn {{ $button->key === $currentGroup ? 'btn-dark' : 'btn-outline-dark' }} my-1 sm:mr-indent-half"
                            wire:click="setGroup('{{ $button->key }}')">
                        {{ $button->title }}
                    </button>
                @endforeach
            </div>
            <x-tt::notifications.error prefix="group-" />
            <x-tt::notifications.success prefix="group-" />
        </div>
    </div>
</div>
