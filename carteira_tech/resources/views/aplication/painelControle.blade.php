<x-div.table-list>
    @section('title', 'ADMIN')
    @slot('tituloCentral')
    PAINEL ADMIN
    @endslot

    @slot('titulo')
        Lista de Usuários
    @endslot
    <h5>{{ verificaCountObjeto($usuarios) }}</h5>
    @slot('botao')
        <x-div.button>
            <x-button.a href="{{ route('createUsuario') }}" role="button" icon='criar'> Cadastrar Usuário</x-button.a>
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
                            <x-label.span class="input-group-text" icon='usuario'>Usuário</x-label.span>
                            <x-input.text type="text" value="{{ old('descricao') }}" placeholder="Procurar Usuário"
                                name="descricao" id="descricao"></x-input.text>
                        </div>
                    </x-div.col>
                    <x-div.col type="auto">
                        <div class="input-group">
                            <x-label.span class="input-group-text" icon='funcao'>Função</x-label.span>
                            <x-input.select id="funcao_id" name="funcao_id">
                                <x-input.option value="">Selecione</x-input.option>
                                @foreach ($funcoes as $funcao)
                                    <x-input.option value="{{ $funcao->id }}">{{ $funcao->name }}</x-input.option>
                                @endforeach
                            </x-input.select>
                        </div>
                    </x-div.col>
                </x-div.row>

                <x-div.button class="mt-2">
                    <x-button.button type="submit" icon='pesquisar'>Resultado</x-button.button>
                    <x-button.a href="{{ route('painelControleUsuario') }}" class="btn btn-dark" icon='limpar'>Limpar Filtros</x-button.a>
                </x-div.button>
            </form>
        </x-div.principal>
    @endslot
    @if (count($usuarios) > 0)
        <x-div.table>
            <x-table.thead>
                <x-table.tr>
                    <x-table.th scope="col">#</x-table.th>
                    <x-table.th scope="col">Nome</x-table.th>
                    <x-table.th scope="col">Função</x-table.th>
                    <x-table.th scope="col">Ações</x-table.th>
                </x-table.tr>
            </x-table.thead>
            <x-table.tbody>
                @foreach ($usuarios as $usuario)
                    <x-table.tr>
                        <x-table.th scope="row">{{ $loop->index + 1 }}</x-table.th>
                        <x-table.td>
                            <x-div.button>
                                <x-button.a class="btn-link" href="{{ route('showUsuario', $usuario->id) }}">{{ $usuario->name }}</x-button.a>
                            </x-div.button>
                        </x-table.td>
                        <x-table.td>{{ $usuario->funcao->name }}</x-table.td>
                        <x-table.td-button>
                            <x-div.button>
                                <x-button.a href="{{ route('editUsuario', $usuario->id) }}"
                                    role="button" icon='editar'>Editar</x-button.a>
                                <x-div.form action="{{ route('deleteUsuario', $usuario->id) }}" id="formButtons"
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
    @endif
</x-div.table-list>
<x-div.paginacao :dados="$usuarios"></x-div.paginacao>