<div class="card">
    <div class="card-body">
        <div class="flex flex-col sm:flex-row flex-nowrap sm:flex-wrap">
            @foreach($buttons as $button)
                <button type="button"
                        class="btn {{ $button->key === $currentGroup ? 'btn-dark' : 'btn-outline-dark' }} my-1 sm:mr-indent-half"
                        wire:click="setGroup('{{ $button->key }}')">
                    {{ $button->title }}
                </button>
            @endforeach
        </div>
    </div>
</div>
