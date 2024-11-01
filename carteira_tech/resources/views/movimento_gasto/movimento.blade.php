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
            <x-button.a class="btn-primary create-btn" href="{{ route('createMovimentoGasto') }}" role="button" icon='criar'>
                Cadastrar Movimentos</x-button.a>
            <x-button.a href="#filtro" class="btn btn-secondary" data-bs-toggle="collapse" icon='filtrar'>Filtrar</x-button.a>
        </x-div.button>
    @endslot
    @slot('filtro')
        <x-div.principal id="filtro" class="collapse mt-2">
            <form autocomplete="off">
                <div class="row">
                    <div class="col-auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='conta'>Movimento</x-label.span>
                            <x-input.text type="text" value="{{ old('descricao') }}"
                            placeholder="Procurar Movimento" name="descricao" id="descricao"></x-input.text>
                        </div>
                    </div>
                </div>
                <x-div.button class="mt-2">
                    <x-button.button type="submit" icon='pesquisar'>Resultado</x-button.button>
                    <x-button.a href="{{ route('indexMovimentoGasto') }}" class="btn btn-dark" icon='limpar'>Limpar
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
                    <x-table.th scope="col">Ações</x-table.th>
                </x-table.tr>
            </x-table.thead>
        <x-table.tbody>
            @foreach ($movimentos as $movimento)
                <x-table.tr>
                    <x-table.th scope="row">{{ $loop->index + 1 }}</x-table.th>
                    <x-table.td>
                        <x-div.button>
                            <x-button.a class="btn-link" href="{{ route('showMovimentoGasto', $movimento->id) }}">{{ $movimento->nome }}</x-button.a>
                        </x-div.button>
                    </x-table.td>
                    <x-table.td-button>
                        <x-div.button>
                            <x-button.a href="{{ route('editMovimentoGasto', $movimento->id) }}"
                                role="button" icon='editar'>Editar</x-button.a>
                            <x-div.form action="{{ route('deleteMovimentoGasto', $movimento->id) }}" id="formButtons"
                                method="POST">
                                @slot('metodo')
                                    DELETE
                                @endslot
                                @slot('botao')
                                    <x-button.button type="submit" icon='deletar'>Deletar
                                    </x-button.button>
                                @endslot
                            </x-div.form>
                        </x-div.button>
                    </x-table.td-button>
                </x-table.tr>
            @endforeach
        </x-table.tbody>
    </x-div.table>
</x-div.table-list>
<div class="d-flex justify-content-center">
    {{ $movimentos->links() }}
</div>