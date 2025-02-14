<div class="space-y-indent-half">
    @if (! empty($blocks) ?? $blocks->count())
        @foreach($blocks as $block)
            <div class="card">
                <div class="card-body">
                </div>
            </div>
        @endforeach
    @endif
</div>
