<div class="table-responsive">
    <table id="minhaTabela" class="table table-hover align-middle text-center shadow-sm">
        <thead class="table-secondary">
            {{ $thead ?? '' }}
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>