<div class="dropdown dropstart">
    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-list"></i>
    </button>
    <ul class="dropdown-menu">
        {{-- Botão Ficha (se existir rota) --}}
        @if($fichaRoute)
            <li>
                <a id="btnFicha{{ $itemId }}" class="dropdown-item" href="{{ $fichaRoute }}" target="_blank">
                    <i class="far fa-file-pdf text-danger me-2"></i>Ficha cadastral
                </a>
            </li>
        @endif

        {{-- Botão e-mail (se existir rota) --}}
        @if($emailRoute)
            <li>
                <a class="dropdown-item {{ $emailDisabled ? 'disabled' : '' }}" href="{{ $emailRoute }}">
                    <i class="far fa-envelope text-primary me-2"></i>Enviar e-mail
                </a>
            </li>
        @endif

        {{-- Botão Editar (se existir rota) --}}
        @if($editRoute)
            <li>                                     
                <a class="dropdown-item" href="{{ $editRoute }}">
                    <i class="fas fa-pencil-alt text-primary me-2"></i>Editar
                </a>
            </li>
        @endif

        {{-- Botão Excluir (se existir rota) --}}        
        @if($deleteRoute && (auth()->user()->can('administrador') || auth()->user()->can('maquinista')))
        <li>
            <form id="formExcluir{{ $itemId }}" action="{{ $deleteRoute }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger" onclick="confirmarExclusao(event, '{{ $itemId }}')">
                    <i class="far fa-trash-alt me-2"></i>Excluir
                </button>
            </form>
        </li>
        @endif       

        {{-- Slot para ações extras --}}
        {{ $slot }}
    </ul>
</div>