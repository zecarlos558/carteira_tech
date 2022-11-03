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
            <x-button.a class="btn-primary create-btn" href="{{ route('createUsuario') }}" role="button" icon='criar'>
                Cadastrar Usuário</x-button.a>
        </x-div.button>
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
            @foreach ($usuarios as $usuario)
                <x-table.tr>
                    <x-table.th scope="row">{{ $loop->index + 1 }}</x-table.th>
                    <x-table.td>
                        <x-div.button>
                            <x-button.a class="btn-link" href="{{ route('showUsuario', $usuario->id) }}">{{ $usuario->name }}</x-button.a>
                        </x-div.button>
                    </x-table.td>
                    <x-table.td-button>
                        <x-div.button>
                            <x-button.a class="btn btn-info edit-btn" href="{{ route('editUsuario', $usuario->id) }}"
                                role="button" icon='editar'>Editar</x-button.a>
                            <x-div.form action="{{ route('deleteUsuario', $usuario->id) }}" id="formButtons"
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

