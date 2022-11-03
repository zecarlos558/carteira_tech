<x-div.table-list>
    @section('title', 'Contas')
    @slot('tituloCentral')
        Contas
    @endslot

    @slot('titulo')
        Lista de Contas
    @endslot
    <h5>{{ verificaCountObjeto($contas) }}</h5>
    @slot('botao')
        <x-div.button>
            <x-button.a class="btn-primary create-btn" href="{{ route('createConta') }}" role="button" icon='criar'>
                Adicionar Novo</x-button.a>
            <x-button.a href="#filtro" class="btn btn-secondary" data-bs-toggle="collapse" icon='filtrar'>Filtrar</x-button.a>
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
                    <x-button.a href="{{ route('indexConta') }}" class="btn btn-dark" icon='limpar'>Limpar
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
            @foreach ($contas as $conta)
                <x-table.tr>
                    <x-table.th scope="row">{{ $loop->index + 1 }}</x-table.th>
                    <x-table.td>
                        <x-div.button>
                            <x-button.a class="btn-link" href="{{ route('showConta', $conta->id) }}">
                                {{ $conta->nome }}</x-button.a>
                        </x-div.button>
                    </x-table.td>
                    <x-table.td-button>
                        <x-div.button>
                            <x-button.a class="btn btn-info edit-btn" href="{{ route('editConta', $conta->id) }}"
                                role="button" icon='editar'>Editar</x-button.a>
                            <x-div.form action="{{ route('deleteConta', $conta->id) }}" id="formButtons"
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
