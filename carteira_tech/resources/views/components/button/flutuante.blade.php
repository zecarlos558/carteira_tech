<div class="fab">
    <button class="main">
    </button>
    <ul>
        <li>
            <label for="opcao1">Contas</label>
            <x-button.a class="btn-primary" href="{{ route('indexConta') }}" icon="conta"></x-button.a>
        </li>
        <li>
            <label for="opcao2">Suprimento</label>
            <x-button.a class="btn-primary" href="{{ route('createMovimentoRenda') }}">R$+</x-button.a>
        </li>
        <li>
            <label for="opcao3">Retirada</label>
            <x-button.a class="btn-primary" href="{{ route('createMovimentoGasto') }}">R$-</x-button.a>
        </li>
    </ul>
</div>
