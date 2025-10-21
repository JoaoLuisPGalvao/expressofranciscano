<div class="dropdown dropstart">
    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-list"></i>
    </button>
    <ul class="dropdown-menu">
        {{-- Botão Baixa Rápida (se existir rota) --}}
        @if($baixarRoute)
            <li>
                <a id="btnBaixar{{ $itemId }}" 
                   class="dropdown-item {{ $baixarDisabled ? 'disabled' : '' }}" 
                   href="{{ $baixarRoute }}"
                   onclick="confirmarBaixa(event, '{{ $itemId }}')">
                    <i class="far fa-thumbs-up text-success me-2"></i>Baixa rápida
                </a>
            </li>
        @endif

        {{-- Botão e-mail (se existir rota) --}}
        @if($emailRoute)
            <li>
                <a class="dropdown-item {{ $emailDisabled ? 'disabled' : '' }}" 
                   href="{{ $emailRoute }}">
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
        @if($deleteRoute)
            @can('adm/master')
            <li>
                <form id="formExcluir{{ $itemId }}" action="{{ $deleteRoute }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger" onclick="confirmarExclusao(event, '{{ $itemId }}')">
                        <i class="far fa-trash-alt me-2"></i>Excluir
                    </button>
                </form>
            </li>
            @endcan
        @endif

        {{-- Slot para ações extras --}}
        {{ $slot }}
    </ul>
</div>