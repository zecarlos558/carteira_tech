<x-div.table-list>
    @section('title', 'Funções')
    @slot('tituloCentral')
        Funções
    @endslot
    @slot('titulo')
        Lista de Funções
    @endslot
    <h5>{{ verificaCountObjeto($funcoes) }}</h5>
    @slot('botao')
        <x-div.button>
            <x-button.a href="{{ route('createRole') }}" role="button" icon='criar'>
                Adicionar Novo</x-button.a>
            <x-button.a href="#filtro" data-bs-toggle="collapse" icon='filtrar'>Filtrar</x-button.a>
        </x-div.button>
    @endslot
    @slot('filtro')
        <x-div.principal id="filtro" class="collapse mt-2">
            <form autocomplete="off">
                <div class="row">
                    <div class="col-auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='funcao'>Nome</x-label.span>
                            <x-input.text type="text" value="{{ old('nome') }}"
                            placeholder="Procurar nome" list="nomes" name="nome" id="nome"></x-input.text>
                            <x-input.datalist id="nomes" >
                                @foreach ($listaFuncoes as $listaFuncao)
                                    <x-input.option value="{{ $listaFuncao }}"></x-input.option>
                                @endforeach
                            </x-input.datalist>
                        </div>
                    </div>
                </div>
                <x-div.button class="mt-2">
                    <x-button.button type="submit" class="btn-success" icon='filtrar'>Resultado</x-button.button>
                    <x-button.a href="{{ route('indexRole') }}" class="btn btn-dark" icon='limpar'>Limpar
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
            @foreach ($funcoes as $funcao)
                <x-table.tr>
                    <x-table.th scope="row">{{ $loop->index + 1 }}</x-table.th>
                    <x-table.td>
                        <x-div.button>
                            <x-button.a class="btn-link" href="{{ route('showRole', $funcao->id) }}">
                                {{ $funcao->name }}</x-button.a>
                        </x-div.button>
                    </x-table.td>
                    <x-table.td-button>
                        <x-div.button>
                            <x-button.a class="btn btn-info edit-btn" href="{{ route('editRole', $funcao->id) }}"
                                role="button" icon='editar'>Editar</x-button.a>
                            <x-div.form action="{{ route('deleteRole', $funcao->id) }}" id="formButtons"
                                method="POST">
                                @slot('metodo')
                                    DELETE
                                @endslot
                                @slot('botao')
                                    <x-button.button type="submit" class="btn-danger delete-btn" icon='deletar'>Deletar
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
