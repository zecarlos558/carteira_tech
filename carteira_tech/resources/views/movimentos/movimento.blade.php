<x-div.table-list>
    @section('title', 'Movimentos')
    @slot('tituloCentral')
    MOVIMENTOS
    @endslot

    @slot('titulo')
        Lista de Movimentos
    @endslot
    <h5>{{ verificaCountObjeto($movimentos) }}</h5>
    @slot('botao')
        <x-div.button>
            <x-button.button type="button" class="btn-primary dropdown-toggle" data-bs-toggle="dropdown" icon="criar">Transação</x-button.button>
            <x-button.a href="#filtro" class="btn btn-secondary" data-bs-toggle="collapse" icon='filtrar'>Filtrar</x-button.a>
            <ul class="dropdown-menu" id="MenuOpcao">
                <li>
                    <x-button.a class="dropdown-item" href="{{ route('createMovimentoRenda') }}">+R$ Entrada</x-button.a>
                </li>
                <li>
                    <x-button.a class="dropdown-item" href="{{ route('createMovimentoGasto') }}">-R$ Saida</x-button.a>
                </li>

            </ul>
        </x-div.button>
    @endslot
    @slot('filtro')
        <x-div.principal id="filtro" class="collapse mt-2">
            <form autocomplete="off">
                <div class="row">
                    <div class="col-auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='conta'>Nome</x-label.span>
                            <x-input.text type="text" value="{{ old('nome') }}"
                            placeholder="Procurar nome" list="nomes" name="nome" id="nome"></x-input.text>
                            <x-input.datalist id="nomes" >
                                @foreach ($listaNomes as $listaNome)
                                    <x-input.option value="{{ $listaNome->nome }}"></x-input.option>
                                @endforeach
                            </x-input.datalist>
                        </div>
                    </div>
                </div>
                <x-div.button class="mt-2">
                    <x-button.button type="submit" class="btn-success" icon='filtrar'>Resultado</x-button.button>
                    <x-button.a href="{{ route('indexMovimento') }}" class="btn btn-dark" icon='limpar'>Limpar
                        Filtros</x-button.a>
                </x-div.button>
            </form>
        </x-div.principal>
    @endslot
    <x-div.table>
            <x-table.thead>
                <x-table.tr>
                    <x-table.th scope="col">#</x-table.th>
                    <x-table.th scope="col">Nome</x-table.th>
                    <x-table.th scope="col">Valor</x-table.th>
                    <x-table.th scope="col">Tipo</x-table.th>
                </x-table.tr>
            </x-table.thead>
        <x-table.tbody>
            @foreach ($movimentos as $movimento)
                <x-table.tr>
                    <x-table.th scope="row">{{ $loop->index + 1 }}</x-table.th>
                    <x-table.td>
                        <x-div.button>
                            @if ($movimento->tipo == 'suprimento')
                                <x-button.a class="btn-link" href="{{ route('showMovimentoRenda', $movimento->id) }}">{{ $movimento->nome }}</x-button.a>
                            @else
                                <x-button.a class="btn-link" href="{{ route('showMovimentoGasto', $movimento->id) }}">{{ $movimento->nome }}</x-button.a>
                            @endif
                        </x-div.button>
                    </x-table.td>
                    <x-table.td>{{$movimento->valor}} R$</x-table.td>
                    <x-table.td><x-status_movimento>{{$movimento->tipo}}</x-status_movimento></x-table.td>
                </x-table.tr>
            @endforeach
        </x-table.tbody>
    </x-div.table>
</x-div.table-list>

