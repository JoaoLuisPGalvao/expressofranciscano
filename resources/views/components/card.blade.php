<div class="card {{ $size }} mx-auto mb-5 mt-1 {{ $border }} {{ $shadow }}">
    @isset($header)
        <div class="card-header bg-transparent">
            {{ $header }}
        </div>
    @endisset

    @isset($body)
        <div class="card-body">
            {{ $body }}
        </div>
    @endisset

    @isset($footer)
        <div class="card-footer bg-transparent text-end">
            {{ $footer }}
        </div>
    @endisset
</div>