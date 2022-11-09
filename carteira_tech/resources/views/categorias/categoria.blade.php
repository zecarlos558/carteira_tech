<x-div.table-list>
    @section('title', 'Categorias')
    @slot('tituloCentral')
        Categorias
    @endslot

    @slot('titulo')
        Lista de Categorias
    @endslot
    <h5>{{ verificaCountObjeto($categorias) }}</h5>
    @slot('botao')
        <x-div.button>
            <x-button.a href="{{ route('createCategoria') }}" role="button" icon='criar'>
                Adicionar Novo</x-button.a>
            <x-button.a href="#filtro" data-bs-toggle="collapse" icon='filtrar'>Filtrar</x-button.a>
        </x-div.button>
    @endslot
    @slot('filtro')
        <x-div.principal id="filtro" class="collapse mt-2">
            <form autocomplete="off">
                <x-div.row>
                    <x-div.col type="auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='categoria'>Categoria</x-label.span>
                            <x-input.text type="text" value="{{ old('categoria') }}" placeholder="Procurar categoria"
                                list="categorias" name="categoria" id="categoria"></x-input.text>
                            <x-input.datalist id="categorias">
                                <x-input.option value=""></x-input.option>
                                @foreach ($listaCategorias as $categoria)
                                    <x-input.option value="{{ $categoria->id }}">{{ $categoria->nome }}</x-input.option>
                                @endforeach
                            </x-input.datalist>
                        </div>
                    </x-div.col>
                    <x-div.col type="auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='grupo'>Grupo</x-label.span>
                            <x-input.select id="grupo" name="grupo">
                                <x-input.option value="">Selecione</x-input.option>
                                @foreach ($grupos as $grupo)
                                    <x-input.option value="{{ $grupo->id }}">{{ $grupo->nome }}</x-input.option>
                                @endforeach
                            </x-input.select>
                        </div>
                    </x-div.col>
                </x-div.row>

                <x-div.button class="mt-2">
                    <x-button.button type="submit" icon='pesquisar'>Resultado</x-button.button>
                    <x-button.a href="{{ route('indexCategoria') }}" class="btn btn-dark" icon='limpar'>Limpar
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
                <x-table.th scope="col">Grupo</x-table.th>
                @if ($categorias->last()->user_id_create == auth()->user()->id)
                    <x-table.th scope="col">Ações</x-table.th>
                @endif
            </x-table.tr>
        </x-table.thead>
        <x-table.tbody>
            @foreach ($categorias as $categoria)
                <x-table.tr>
                    <x-table.th scope="row">{{ $loop->index + 1 }}</x-table.th>
                    <x-table.td>
                        <x-div.button>
                            <x-button.a class="btn-link" href="{{ route('showCategoria', $categoria->id) }}">
                                {{ $categoria->nome }}</x-button.a>
                        </x-div.button>
                    </x-table.td>
                    <x-table.td> {{ $categoria->grupos[0]->nome }} </x-table.td>

                    @if ($categoria->user_id_create == auth()->user()->id)
                        <x-table.td-button>
                            <x-div.button>
                                <x-button.a href="{{ route('editCategoria', $categoria->id) }}" role="button"
                                    icon='editar'>Editar</x-button.a>
                                <x-div.form action="{{ route('deleteCategoria', $categoria->id) }}" id="formButtons"
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
                    @endif

                </x-table.tr>
            @endforeach
        </x-table.tbody>
    </x-div.table>
</x-div.table-list>
