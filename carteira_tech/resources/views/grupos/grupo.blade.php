<x-div.table-list>
    @section('title', 'Grupos')
    @slot('tituloCentral')
        GRUPOS
    @endslot

    @slot('titulo')
        Lista de Grupos
    @endslot
    <h5>{{ verificaCountObjeto($grupos) }}</h5>
    @slot('botao')
        <x-div.button>
            <x-button.a href="{{ route('createGrupo') }}" role="button" icon='criar'>
                Adicionar Novo</x-button.a>
            <x-button.a href="#filtro" data-bs-toggle="collapse" icon='filtrar'>Filtrar</x-button.a>
        </x-div.button>
    @endslot
    @slot('filtro')
        <x-div.principal id="filtro" class="collapse mt-2">
            <form autocomplete="off">
                <x-input.text id="offset_busca" name="offset_busca" value="{{$offset ?? session()->get('offset')}}" style="display: none;"></x-input.text>
                <x-div.row>
                    <x-div.col type="auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='grupo'>Grupo</x-label.span>
                            <x-input.text type="text" value="{{ old('descricao') }}" placeholder="Procurar grupo"
                                name="descricao" id="descricao"></x-input.text>
                        </div>
                    </x-div.col>
                </x-div.row>
                <x-div.button class="mt-2">
                    <x-button.button type="submit" icon='pesquisar'>Resultado</x-button.button>
                    <x-button.a href="{{ route('indexGrupo') }}" class="btn btn-dark" icon='limpar'>Limpar
                        Filtros</x-button.a>
                </x-div.button>
            </form>
        </x-div.principal>
    @endslot
    @if (count($grupos) > 0)
        <x-div.table>
            <x-table.thead>
                <x-table.tr>
                    <x-table.th scope="col">#</x-table.th>
                    <x-table.th scope="col">Nome</x-table.th>
                    @if ($grupos->where('user_id_create', '=', auth()->user()->id)->isNotEmpty())
                        <x-table.th scope="col">Ações</x-table.th>
                    @endif
                </x-table.tr>
            </x-table.thead>
            <x-table.tbody>
                @foreach ($grupos as $grupo)
                    <x-table.tr>
                        <x-table.th scope="row">{{ $loop->index + 1 }}</x-table.th>
                        <x-table.td>
                            <x-div.button>
                                <x-button.a class="btn-link" href="{{ route('showGrupo', $grupo->id) }}">
                                    {{ $grupo->nome }}</x-button.a>
                            </x-div.button>
                        </x-table.td>

                        @if ($grupo->user_id_create == auth()->user()->id)
                            <x-table.td-button>
                                <x-div.button>
                                    <x-button.a href="{{ route('editGrupo', $grupo->id) }}" role="button" icon='editar'>
                                        Editar</x-button.a>
                                    <x-div.form action="{{ route('deleteGrupo', $grupo->id) }}" id="formButtons"
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
    @endif
</x-div.table-list>
<x-div.paginacao :dados="$grupos"></x-div.paginacao>
